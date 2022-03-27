<?php

namespace Tests\Feature;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenderTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/genders';

    public function test_gender_endpoint_exist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertOk();
    }

    public function test_attributes_required_fails()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
                        ->postJson($this->basePath, []);
        $response->assertStatus(422); //(name, abbr => max:4 )parameters required
    }

    public function test_store_gender()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, ['name' => 'Varonil','abbr'=> 'v']);
        $response->assertCreated();
    }

    public function test_get_all()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertExactJson(['data' => []]);
    }

    public function test_update_gender()
    {
        $user = User::factory()->create();
        $attributes = ['name' => 'Femenil','abbr' =>'f'];

        Gender::create($attributes);

        $attributes['name'] = 'Varonil';
        $attributes['abbr'] = 'v';

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);

        $response->assertSuccessful();
    }

    public function test_delete_gender()
    {
        $attributes = ['name' => 'Femenil','abbr' =>'f'];
        $user = User::factory()->create();

        Gender::create($attributes);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {
        $attributes = ['name' => 'Femenil','abbr' =>'f'];
        $user = User::factory()->create();

        Gender::create($attributes);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'genders','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was hard deleted successfully"]]);
    }


}

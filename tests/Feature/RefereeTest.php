<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RefereeTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/referees';

    public function test_referee_endpoint_exist()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);

        $response->assertOk()
        ->assertJsonStructure(['data'=>[]]);
    }

    public function test_attributes_required_fails()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, []);
        $response->assertStatus(422);
    }

    public function test_store_referee()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, [
                'name'=> 'Jose Sagit',
                'paternal_name'=> 'Gutierrez',
                'maternal_name'=> 'Terrazas',
                'email'=> 'test@test.com',
                'birthdate'=> '1989-04-05',
                'phone'=> '3222397179',
                'type'=> 'central',
                ]);
        $response->dump();
        $response->assertCreated();
    }

    public function test_get_all()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);

        $response->assertExactJson(['data' => []]);
    }

    public function test_update_referee()
    {
        $user = User::factory()->make();
        $this->createReferee();
        $attributes = [
            'name'=> 'Jose Sagit updated',
            'paternal_name'=> 'Gutierrez updated',
            'maternal_name'=> 'Terrazas updated',
            'birthdate'=> '1989-01-01',
            'phone'=> '1234567890',
            'password'=> Str::random(8),
            'email'=> 'test@test.com',
            ];


        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);

        $response->assertSuccessful();
    }

    public function test_delete_referee()
    {
        $user = User::factory()->make();

       $this->createReferee();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {
        $attributes = ['name' => 'Femenil','abbr' =>'f'];
        $user = User::factory()->make();

        $this->createReferee();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'users','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was hard deleted successfully"]]);
    }
    private function createReferee()
    {
        $attributes = [
            'name'=> 'Jose Sagit',
            'paternal_name'=> 'Gutierrez',
            'maternal_name'=> 'Terrazas',
            'email'=> 'test@test.com',
            'password'=> Str::random(8),
            'birthdate'=> '1989-04-05', 'phone'=> '3222397179', 'type'=> 'central',
        ];

        User::create($attributes);
    }
}

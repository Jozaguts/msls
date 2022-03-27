<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/categories';

    public function test_category_endpoint_exist()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertOk()
        ->assertExactJson(['data'=> []]);
    }

    public function test_attributes_required_fails()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, []);
        $response->assertStatus(422);
    }

    public function test_store_category()
    {

        $user = User::factory()->create();
        Gender::create(['name' => 'Femenil','abbr' => 'f']);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, ['name' => 'Premier','gender_id'=> '1']);
        $response->assertCreated()
        ->assertJsonStructure(['data' => ['id','name','gender_id','created_at','updated_at']]);
    }

    public function test_get_all()
    {
        $user = User::factory()->create();
        $this->createCategories();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertJsonStructure(['data' => [ ['id','name','gender_id','created_at','updated_at']]]);
    }

    public function test_update_category_dont_accept_repeated_values()
    {
        $user = User::factory()->create();
        $this->createCategories();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",['name' => 'Premier','gender_id' => 1]);
        $response->assertStatus(422);
    }
    public function test_update_category()
    {
        $user = User::factory()->create();
        $this->createCategories();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",['name' => 'Premier 2','gender_id' => 1]);
        $response->assertStatus(200)
        ->assertJsonStructure(['data'=>['id','name','gender_id','created_at','updated_at']]);
    }

    public function test_delete_category()
    {
        $user = User::factory()->create();

       $this->createCategories();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {

        $user = User::factory()->create();

        $this->createCategories();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'categories','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was hard deleted successfully"]]);
    }

    private function createCategories()
    {
        $genderData = ['name' => 'Femenil','abbr' =>'f'];
        $categoriesData =['name' => 'Premier', 'gender_id'=> 1];

        Gender::create($genderData);
        Category::create($categoriesData);
    }
}

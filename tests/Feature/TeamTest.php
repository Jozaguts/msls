<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Gender;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/teams';

    public function test_team_endpoint_exist()
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

    public function test_store_team()
    {
        $user = User::factory()->make();

        $genderData = ['name' => 'Femenil','abbr' =>'f'];
        $categoriesData =['name' => 'Premier', 'gender_id'=> 1];

        Gender::create($genderData);
        Category::create($categoriesData);
        $categoriesData['name'] = 'juvenil';
        Category::create($categoriesData);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, [
                'name' => 'Cruz Azul',
                'category_id'=> 1,
            ]);
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, [
                'name' => 'Cruz Azul',
                'category_id'=> 2,
            ]);
        $response->assertCreated()
            ->assertJson(['data' => [  'name' => 'Cruz Azul', 'category_id'=> 2]]);
    }

    public function test_get_all()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertExactJson(['data' => []]);
    }

    public function test_update_team()
    {
        $user = User::factory()->make();
        $this->createteam();
        $attributes = [
            'name' => 'Cruz azul Updated',
            'group' => 'a',
            'category_id' => 1,
            'won' => 3,
            'draw' => 3,
            'lost' => 3,
            'goals_against' => 10,
            'goals_for' => 20,
            'goals_difference' => 10,
            'points' => 12
        ];

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);
        $response->assertSuccessful()
            ->assertJson(['data' => $attributes]);
    }

    public function test_delete_team()
    {
        $user = User::factory()->make();

        $this->createteam();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {

        $user = User::factory()->make();

        $this->createteam();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'teams','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was hard deleted successfully"]]);
    }

    private function createteam()
    {

        $genderData = ['name' => 'Femenil','abbr' =>'f'];
        $categoriesData =['name' => 'Premier', 'gender_id'=> 1];

        Gender::create($genderData);
        Category::create($categoriesData);

        $attributes = ['name' => 'Cruz Azul', 'category_id'=> 1,];

        Team::create($attributes);
    }
}

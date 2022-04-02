<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/games';

    public function test_game_endpoint_exist()
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

    public function test_store_game()
    {
        Artisan::call('migrate:fresh --seed');
        $user = User::factory()->make();
        $params = [
            'date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, $params);
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

    public function test_update_game()
    {
        $user = User::factory()->make();
        $this->creategame();
        $attributes = ['date' => now(), 'location' => 'La sabana updated', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);

        $response->assertSuccessful();
    }

    public function test_delete_game()
    {
        $user = User::factory()->make();

        $this->creategame();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {

        $user = User::factory()->make();

        $this->creategame();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'games','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was hard deleted successfully"]]);
    }

    private function creategame()
    {
        Artisan::call('migrate:fresh --seed');
        $params = [
            'date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        Game::create($params);
    }
}

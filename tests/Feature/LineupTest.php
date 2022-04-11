<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Lineup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LineupTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/lineups';

    public function setUp():void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_game_details_endpoint_exist()
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

    public function test_store_game_details()
    {

        $user = User::factory()->make();
        $game = Game::create(['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1]);
        $params = [
            'game_id' => $game->id,
            'player_id' => 1,
            'first_team_player' => 1,
            'round' => 'jornada 1',
        ];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, $params);
        $response->assertCreated();

    }

    public function test_get_all_game_details()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);

        $response->assertExactJson(['data' => []]);
    }

    public function test_update_game_details()
    {
        $user = User::factory()->make();
        $params = ['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $game = Game::create($params);
        $attributes =  [
            'game_id' => $game->id,
            'player_id' => 1,
            'first_team_player' => 1,
            'round' => 'jornada 2'];
        Lineup::create($attributes);
        $attributes['round'] = 'jornada 2 updated';
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);
        $response->assertOk();
    }

    public function test_delete_game_details()
    {
        $user = User::factory()->make();
        $params = ['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $game = Game::create($params);
        $attributes =  [
            'game_id' => $game->id,
            'player_id' => 1,
            'first_team_player' => 1,
            'round' => 'jornada 2'];
        Lineup::create($attributes);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {
        $user = User::factory()->make();
        $params = ['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $game = Game::create($params);
        $attributes =  [
            'game_id' => $game->id,
            'player_id' => 1,
            'first_team_player' => 1,
            'round' => 'jornada 2'];
        Lineup::create($attributes);

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'lineups','id'=> 1]);
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was hard deleted successfully"]]);
    }
}

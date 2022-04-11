<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameActionDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GameActionDetailTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/game-action-details';

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
            'action_id' => 1,
            'game_id' => $game->id,
            'player_id' => $user->id,
            'time' => '10:00',
            'comment' => null,
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
            'action_id' => 1,
            'game_id' => $game->id,
            'player_id' => 1,
            'minute' => '10:00',
            'comment' => 'updated',];
        $action = GameActionDetail::create($attributes );
        $attributes['time'] = '11:00';
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);
        $response->assertOk();
    }

    public function test_delete_game_details()
    {
        $this->createGame();
        $this->createDetails();
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {

        $this->createGame();
        $user = User::factory()->make();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'games','id'=> 1]);
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was hard deleted successfully"]]);
    }

    private function createGame()
    {

        $params = [
            'date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        Game::create($params);
    }

    private function createDetails()
    {

        $user = User::factory()->make();
        Game::create([ 'date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1]);

        $params = [
            'game_id'=> 1,
            'local_color'=> 'blue',
            'away_color'=> 'red',
            'local_captain_id'=> 1,
            'away_captain_id'=> 2,
            'referee_id'=> 3,
            'first_assistance_referee_id'=> 4,
            'second_referee_id'=> 5,
            'third_referee_id'=> 6,
        ];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, $params);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameTimeDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GameTimeDetailsTable extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/game-time-details';
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_game_time_details_endpoint_exist()
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

    public function test_store_game_time_details()
    {
        $user = User::factory()->make();
        $game = Game::create(['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1]);
        $params = [
            'game_id' => $game->id,
            'first_time_start' => '10:30',
            'first_time_end' => '11:15',
            'second_time_start' => '11:30',
            'second_time_end' => '12:45',
            'prorogue_minutes_start' => '00',
            'first_time_extra_time' => '05',
            'second_time_extra_time' => '05',
            ];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, $params);
        $response->assertCreated();

    }

    public function test_get_all_game_time_details()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);

        $response->assertExactJson(['data' => []]);
    }

    public function test_update_game_time_details()
    {
        $user = User::factory()->make();
        $params = ['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $game = Game::create($params);
        $attributes = [
            'game_id' => $game->id,
            'first_time_start' => '10:30',
            'first_time_end' => '11:15',
            'second_time_start' => '11:30',
            'second_time_end' => '12:45',
            'prorogue_minutes_start' => '00',
            'first_time_extra_time' => '05',
            'second_time_extra_time' => '05',
        ];
        GameTimeDetail::create($attributes);
        $attributes['second_time_extra_time'] = '00';
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);

        $response->assertOk();
    }
    public function test_delete_game_time_details()
    {
        $user = User::factory()->make();
        $params = ['date' => now(), 'location' => 'La sabana', 'home_team_id' => 1, 'away_team_id' => 2, 'category_id' => 1];
        $game = Game::create($params);
        $attributes = [
            'game_id' => $game->id,
            'first_time_start' => '10:30',
            'first_time_end' => '11:15',
            'second_time_start' => '11:30',
            'second_time_end' => '12:45',
            'prorogue_minutes_start' => '00',
            'first_time_extra_time' => '05',
            'second_time_extra_time' => '05',
        ];
        GameTimeDetail::create($attributes);
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
        $attributes = [
            'game_id' => $game->id,
            'first_time_start' => '10:30',
            'first_time_end' => '11:15',
            'second_time_start' => '11:30',
            'second_time_end' => '12:45',
            'prorogue_minutes_start' => '00',
            'first_time_extra_time' => '05',
            'second_time_extra_time' => '05',
        ];
        GameTimeDetail::create($attributes);
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'game_time_details','id'=> 1]);
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "register was hard deleted successfully"]]);
    }
}

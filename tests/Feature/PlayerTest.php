<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use RefreshDatabase;
    private string $basePath = '/api/v1/players';

    public function test_player_endpoint_exist()
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

    public function test_store_player()
    {
        Artisan::call('migrate:fresh --seed');
        $user = User::factory()->create();
        $attributes = [
            'user_id'=> 1,
            'jersey_num' => 5,
            'team_id' => 1,
            'position_id'=> 1];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson($this->basePath, $attributes);

        $response->assertCreated()
            ->assertJson(['data' => $attributes]);
    }

    public function test_get_all()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->get($this->basePath);
        $response->assertExactJson(['data' => []]);
    }

    public function test_update_player()
    {

        $user = User::factory()->make();
        $this->createplayer();
        $attributes = [
            'user_id'=>1,
            'jersey_num' => 9,
            'team_id' => 1,
            'position_id'=> 1]
        ;

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->putJson("{$this->basePath}/1",$attributes);

        $response->assertSuccessful()
            ->assertJson(['data' => $attributes]);
    }

    public function test_delete_player()
    {
        $user = User::factory()->make();

        $this->createplayer();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->deleteJson("{$this->basePath}/1");
        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was deleted successfully"]]);
    }

    public function test_hard_delete()
    {

        $user = User::factory()->make();

        $this->createplayer();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->postJson("api/v1/hard-delete",['table'=>'players','id'=> 1]);

        $response->assertSuccessful()
            ->assertExactJson(['data' => ["message" => "The register was hard deleted successfully"]]);
    }

    private function createplayer()
    {
        Artisan::call('migrate:fresh --seed');
        $attributes = ['user_id'=>1,'birthdate' => '1989-04-05', 'jersey_num' => 5, 'team_id' => 1, 'position_id'=> 1];

        player::create($attributes);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $user = new \App\Models\User();
            $user->name = 'Jose Sagit';
            $user->paternal_name = 'Gutierrez';
            $user->maternal_name = 'Terrazas';
            $user->phone = '3222397179';
            $user->email = 'admin@sls.com';
            $user->password = Hash::make('password');
            $user->email_verified_at = now();
         $user->save();
         \App\Models\User::factory()->count(175)->create();
        $this->call(PositionsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(ActionTableSeeder::class);
        Artisan::call('passport:install');
        $players = Player::factory()
            ->count(175)
            ->state(new Sequence(
                ['team_id' => 1,],
                ['team_id' => 2,],
                ['team_id' => 3,],
                ['team_id' => 4,],
                ['team_id' => 5,],
                ['team_id' => 6,],
                ['team_id' => 7,],

            ))
            ->create();
    }
}

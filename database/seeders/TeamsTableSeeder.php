<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name'=> 'Cruz azul',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'America',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'Chivas',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'Pumas',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'Toluca',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'Santos',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
            [
                'name'=> 'Pachuca',
                'group'=> null,
                'won'=> null,
                'draw'=> null,
                'lost'=> null,
                'goals_against'=> null,
                'goals_for'=> null,
                'goals_difference'=> null,
                'points'=> null,
                'category_id'=> 1,
            ],
        ];

        foreach($teams as $team){
            DB::table('teams')->insert($team);
        }
    }
}

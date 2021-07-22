<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert(['name'=> 'varonil','abbr' =>'v']);
        DB::table('genders')->insert(['name'=> 'femenil','abbr' =>'f']);
    }
}

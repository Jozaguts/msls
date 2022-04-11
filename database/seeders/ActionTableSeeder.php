<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $actions = [
          'goal',
          'yellow card',
          'red card',
          'penalty',
      ];
      foreach ($actions as $action) {
          Action::create(['name' => $action]);
      }
    }
}

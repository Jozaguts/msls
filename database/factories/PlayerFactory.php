<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name(),
            'age'=> $this->faker->numberBetween(15, 40),
            'jersey_num'=> $this->faker->numberBetween(1, 25),
            'team_id' => 3,
            'position_id' => rand(1,12)
        ];
    }
}

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
            'name'=> $this->faker->firstName,
            'paternal_name'=> $this->faker->lastName,
            'maternal_name'=> $this->faker->lastName,
            'birthdate'=> $this->faker->date('Y-m-d','2010-01-01'),
            'jersey_num'=> $this->faker->numberBetween(1, 25),
            'team_id' => 3,
            'position_id' => rand(1,12)
        ];
    }
}

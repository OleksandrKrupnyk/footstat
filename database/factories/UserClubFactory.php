<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'club_id' => 1,
            'opponent_club_id' => 2,
            'update_club_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'update_opponent_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
        ];
    }
}

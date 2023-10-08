<?php

namespace Database\Factories\Users;

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
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
        ];
    }
}

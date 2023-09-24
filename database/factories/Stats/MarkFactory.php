<?php

namespace Database\Factories\Stats;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stats\Mark>
 */
class MarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'club_id' => 1,
            'club_criteria_id' => 1,
            'user_id' => 1,
            'scale_type' => 'NUMBER',
            'mark_value' => '0',
            'created_at' => $this->faker->dateTimeBetween('-2 year', '+6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-2 year', '+6 month'),
        ];
    }
}

<?php

namespace Database\Factories\Handbook;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Handbook\Scale>
 */
class ScaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scale_type' => 'NUMBER',
            'title' => 'Шкала '.$this->faker->numberBetween(1,10),
            'description' => 'Опис шкали',
            'max_value' => $this->faker->numberBetween(5,10)*10,
            'offset' => 0,
            'step' => '1',
            'is_enable' => '1',
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
        ];
    }
}

<?php

namespace Database\Factories\Handbook;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Handbook\Criterion>
 */
class CriterionFactory extends Factory
{
    const Title = ['Оцінювання емблеми','Оцінювання тренера', 'Оцінювання власника'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'scale_id' => '1',
            'title' => '',
            'is_enable' => 1,
            'created_at' =>  $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' =>  $this->faker->dateTimeBetween('-1 year', '-6 month'),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstNameMale() . ' ' . fake()->lastName(),
            'number' => fake()->numberBetween(1, 99),
            'birthdate' => fake()->dateTimeBetween('-35 years','-18 years'),
            'team_id' => null,
        ];

    }
}

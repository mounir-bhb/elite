<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Revenu>
 */
class RevenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'montant'=> 1000,
            'recette' => 5000,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
    /* public function withRandomCreatedAt()
    {
        return $this->state([
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    } */
}

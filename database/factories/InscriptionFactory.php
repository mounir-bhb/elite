<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscription>
 */
class InscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price_id'=>1,
            'formation_id'=>1,
            'student_id'=>$this->faker->unique()->numberBetween(2, 301),
        ];
    }
    public function withRandomCreatedAt()
    {
        return $this->state([
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}

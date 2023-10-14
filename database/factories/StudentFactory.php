<?php

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Cycle_id' => 1,
            'filiere_id' => 1,
            'annee_id' => 1,
            'tel'=> '0558055878',
            'sex' => 'homme',
            'date_naissance'=> fake()->date()
        ];
    }
}

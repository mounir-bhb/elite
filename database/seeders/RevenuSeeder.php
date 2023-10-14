<?php

namespace Database\Seeders;

use App\Models\Revenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RevenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* for ($i = 0; $i < 3000; $i++) {
            Revenu::factory()->create([
                'created_at' => now()->subDays(rand(1, 365)), // Random date within the last year
            ]);
        } */
    }
}

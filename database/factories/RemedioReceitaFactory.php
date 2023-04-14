<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RemedioReceita>
 */
class RemedioReceitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'remedio_id' => \App\Models\Remedio::factory(),
            'receita_id' => \App\Models\Receita::factory(),
            'posologia' => $this->faker->text(500),
        
        ];
    }
}

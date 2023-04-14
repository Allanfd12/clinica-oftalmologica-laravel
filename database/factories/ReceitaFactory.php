<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receita>
 */
class ReceitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'paciente_id' => \App\Models\Paciente::factory(),
            'medico_id' => \App\Models\Medico::factory(),
            'observacao' => $this->faker->text(),
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consulta>
 */
class ConsultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_consulta' => $this->faker->date(),
            'hora_consulta' => $this->faker->time(),
            'medico_id' => \App\Models\Medico::factory(),
            'paciente_id' => \App\Models\Paciente::factory(),
        ];
    }
}

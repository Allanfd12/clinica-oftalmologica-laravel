<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prontuario>
 */
class ProntuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $prontuario_descricao = $this->faker->text(255);
        $prontuario_qp = $this->faker->text(255);
        $prontuario_biomicoscopia = $this->faker->text(255);
        $prontuario_conduta = $this->faker->text(255);
        $prontuario_grau = $this->faker->text(255);
        $prontuario_paciente_id = $this->faker->unique()->numberBetween(1, 100);
        return [
            'descricao' => $prontuario_descricao,
            'qp' => $prontuario_qp,
            'biomicoscopia' => $prontuario_biomicoscopia,
            'conduta' => $prontuario_conduta,
            'grau' => $prontuario_grau,
            'paciente_id' => $prontuario_paciente_id,
        ];
    }
}

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
        return [
            'descricao' =>$this->faker->text(255),
            'qp' =>$this->faker->text(255),
            'biomicoscopia' =>$this->faker->text(255),
            'conduta' =>$this->faker->text(255),
            'grau' =>$this->faker->text(255),
            'paciente_id' =>\App\Models\Paciente::factory(),
        ];
    }
}

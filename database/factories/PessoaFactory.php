<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
            'data_nacimento' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
            'endereco_id' => \App\Models\Endereco::factory(),

        ];
    }
}

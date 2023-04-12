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

        $pessoa_nome = $this->faker->name;
        $pessoa_cpf = $this->faker->unique()->numberBetween(10000000000, 99999999999);
        $pessoa_data_nacimento = $this->faker->date();
        $pessoa_fucao = $this->faker->jobTitle;
        $pessoa_email = $this->faker->unique()->safeEmail;
        $pessoa_telefone = $this->faker->unique()->numberBetween(10000000000, 99999999999);
        $pessoa_endereco_id = $this->faker->unique()->numberBetween(1, 100);

        return [
            'nome' => $pessoa_nome,
            'cpf' => $pessoa_cpf,
            'data_nacimento' => $pessoa_data_nacimento,
            'fucao' => $pessoa_fucao,
            'email' => $pessoa_email,
            'telefone' => $pessoa_telefone,
            'endereco_id' => $pessoa_endereco_id,
        ];
    }
}

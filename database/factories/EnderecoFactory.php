<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Endereco>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $endereco_rua = $this->faker->streetName;
        $endereco_numero = $this->faker->buildingNumber;
        $endereco_bairro = $this->faker->citySuffix;
        $endereco_cidade = $this->faker->city;
        $endereco_estado = $this->faker->city;
        $endereco_cep = $this->faker->postcode;
        $endereco_complemento = $this->faker->secondaryAddress;


        return [
            'rua' => $endereco_rua,
            'numero' => $endereco_numero,
            'bairro' => $endereco_bairro,
            'cidade' => $endereco_cidade,
            'estado' => $endereco_estado,
            'cep' => $endereco_cep,
            'complemento' => $endereco_complemento,
        ];
    }
}

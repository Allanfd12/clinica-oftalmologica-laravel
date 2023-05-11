<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medico>
 */
class MedicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'users_id' => \App\Models\User::factory(),
            'crm' => $this->faker->numberBetween(100000, 999999).'/'.strtoupper($this->faker->randomLetter.$this->faker->randomLetter),
            'especialidade' => $this->faker->text(20),
        ];
    }
}

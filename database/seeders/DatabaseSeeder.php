<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\UserModulo::factory(100)->create();
        \App\Models\Prontuario::factory(100)->create();
        \App\Models\Consulta::factory(100)->create();
        \App\Models\RemedioReceita::factory(100)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);


    }
}

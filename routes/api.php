<?php

use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PessoaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pacientes/search', [PacienteController::class, 'search'])->name('pacientes.search');
Route::get('/medicos/search', [MedicoController::class, 'search'])->name('medicos.search');
Route::get('/cpf', [PessoaController::class, 'verifyCpf'])->name('pessoa.verifyCpf');

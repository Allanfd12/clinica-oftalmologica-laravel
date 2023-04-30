<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//ROTAS DO PACIENTE
Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.list');
Route::get('/pacientes/criar', [PacienteController::class, 'create'])->name('pacientes.criar');
Route::post('/pacientes/store', [PacienteController::class, 'store'])->name('pacientes.store');
Route::get('/pacientes/{id}/editar', [PacienteController::class, 'edit'])->name('pacientes.editar');
Route::patch('/pacientes/{id}/atualizar', [PacienteController::class, 'update'])->name('pacientes.atualizar');
Route::get('/pacientes/{id}/visualizar', [PacienteController::class, 'show'])->name('pacientes.visualizar');
Route::get('/pacientes/{id}/excluir', [PacienteController::class, 'destroy'])->name('pacientes.excluir');


//ROTAS DO USUARIO
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.list');
Route::get('/usuarios/criar', [UserController::class, 'create'])->name('usuarios.criar');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
Route::patch('/usuarios/{id}/atualizar', [UserController::class, 'update'])->name('usuarios.atualizar');
Route::get('/usuarios/{id}/visualizar', [UserController::class, 'show'])->name('usuarios.visualizar');
Route::get('/usuarios/{id}/excluir', [UserController::class, 'destroy'])->name('usuarios.excluir');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

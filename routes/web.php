<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Pacientes\ListPacientesComponent;

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

Route::get('/pacientes',  ListPacientesComponent::class)->name('pacientes.list');
Route::get('/pacientes/criar', [PacienteController::class, 'create'])->name('pacientes.criar');
Route::post('/pacientes/store', [PacienteController::class, 'store'])->name('pacientes.store');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.list');
Route::get('/usuarios/criar', [UserController::class, 'create'])->name('usuarios.criar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ProfileController;
use App\Models\Paciente;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProntuarioController;
use App\Http\Controllers\UserController;
use App\Models\Medico;
use App\Models\User;

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
// group
Route::middleware('auth')->group(function () {
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

//ROTAS DO MÉDICO
Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.list');
Route::get('/medicos/criar', [MedicoController::class, 'create'])->name('medicos.criar');
Route::post('/medicos/store', [MedicoController::class, 'store'])->name('medicos.store');
Route::get('/medicos/{id}/editar', [MedicoController::class, 'edit'])->name('medicos.editar');
Route::patch('/medicos/{id}/atualizar', [MedicoController::class, 'update'])->name('medicos.atualizar');
Route::get('/medicos/{id}/visualizar', [MedicoController::class, 'show'])->name('medicos.visualizar');
Route::get('/medicos/{id}/excluir', [MedicoController::class, 'destroy'])->name('medicos.excluir');

//ROTAS DOS PRONTUÁRIOS
Route::get('/prontuarios', [ProntuarioController::class, 'index'])->name('prontuarios.list');
Route::get('/prontuarios/criar', [ProntuarioController::class, 'create'])->name('prontuarios.criar');
Route::post('/prontuarios/store', [ProntuarioController::class, 'store'])->name('prontuarios.store');
Route::get('/prontuarios/{id}/editar', [ProntuarioController::class, 'edit'])->name('prontuarios.editar');
Route::patch('/prontuarios/{id}/atualizar', [ProntuarioController::class, 'update'])->name('prontuarios.atualizar');
Route::get('/prontuarios/{id}/visualizar', [ProntuarioController::class, 'show'])->name('prontuarios.visualizar');
Route::get('/prontuarios/{id}/excluir', [ProntuarioController::class, 'destroy'])->name('prontuarios.excluir');

//ROTAS DA CONSULTA
Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.list');
Route::get('/consultas/criar', [ConsultaController::class, 'create'])->name('consultas.criar');
Route::post('/consultas/store', [ConsultaController::class, 'store'])->name('consultas.store');
Route::get('/consultas/{id}/editar', [ConsultaController::class, 'edit'])->name('consultas.editar');
Route::patch('/consultas/{id}/atualizar', [ConsultaController::class, 'update'])->name('consultas.atualizar');
Route::get('/consultas/{id}/visualizar', [ConsultaController::class, 'show'])->name('consultas.visualizar');
Route::get('/consultas/{id}/excluir', [ConsultaController::class, 'destroy'])->name('consultas.excluir');

//ROTAS DO PERFIL
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//ROTAS DE BUSCA
Route::get('/pacienteId', function (Illuminate\Http\Request $request) {
    $pessoaId = $request->input('pessoaId');

    // Consultar o banco de dados para obter o paciente_id
    $paciente = Paciente::where('pessoa_id', $pessoaId)->first();

    if ($paciente) {
        $pacienteId = $paciente->id;
        return response()->json(['pacienteId' => $pacienteId]);
    } else {
        return response()->json(['error' => 'Paciente não encontrado'], 404);
    }
})->name('pacientes.findId');

//ROTAS DE BUSCA
Route::get('/medicoId', function (Illuminate\Http\Request $request) {
    $pessoaIdMedico = $request->input('pessoaIdMedico');

    // Consultar o banco de dados para obter o paciente_id
    $user = User::where('pessoa_id', $pessoaIdMedico)->first();
    $medico = Medico::Where('users_id', $user->id)->first();

    if ($medico) {
        $medicoId = $medico->id;
        return response()->json(['medicoId' => $medicoId]);
    } else {
        return response()->json(['error' => 'Médico não encontrado'], 404);
    }
})->name('medicos.findId');
});


require __DIR__.'/auth.php';

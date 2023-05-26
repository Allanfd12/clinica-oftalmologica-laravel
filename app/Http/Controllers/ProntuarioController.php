<?php

namespace App\Http\Controllers;
use App\Models\Prontuario;

class ProntuarioController extends Controller
{
    public function selecionar($paciente_id)
    {
        $prontuario = Prontuario::find($paciente_id);

        return view('prontuarios.selecionar', compact('prontuario'));
    }
    public function index()
    {
        $search = request()->query('search');
        $prontuarios = Prontuario::orderBy('updated_at', 'desc')
            ->from('prontuarios as pr')
            ->join('pacientes as pa', 'pr.paciente_id', '=', 'pa.id')
            ->join('pessoas as pe', 'pa.pessoa_id', '=', 'pe.id')
            ->select('pr.*', 'pe.nome')
            ->where('pe.nome', 'like', "%{$search}%")
            ->paginate(10)->withQueryString();
        
        foreach ($prontuarios as $prontuario) {
            $prontuario->updated_at_formatted = $prontuario->updated_at->format('d/m/Y');
        }

        return view('prontuarios.list', ['prontuarios' => $prontuarios, 'search' => $search], compact('prontuarios'));
    }

    public function create()
    {
        $prontuarios = Prontuario::all();
        return view('prontuarios.criar', compact('prontuarios'));
    }

    public function edit($id)
    {   
        $prontuario = Prontuario::findOrFail($id);
        $paciente = $prontuario->paciente;
        $nome = $paciente->pessoa->nome;
        $cpf = $paciente->pessoa->cpf;

        return view('prontuarios.editar', compact('prontuario', 'nome', 'cpf'));
    }

    public function show($id)
    {
        $prontuario = Prontuario::findOrFail($id);
        $paciente = $prontuario->paciente;
        $nome = $paciente->pessoa->nome;
        $cpf = $paciente->pessoa->cpf;

        return view('prontuarios.visualizar', compact('prontuario', 'nome', 'cpf'));
    }

    public function destroy($id)
    {
        $registro = Prontuario::find($id);
        $registro->delete();

        return redirect()->route('prontuarios.list');
    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProntuarioRequest;
use App\Models\Prontuario;
use Illuminate\Support\Facades\DB;

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
        return view('prontuarios.criar');
    }

    public function store(StoreProntuarioRequest $request)
    {
        DB::transaction(function () use ($request) {

            $prontuario = new Prontuario();
            $pacienteId = $request->input('pacienteId');
            $prontuario->paciente_id = $pacienteId; //! CUIDADO
            $prontuario->grau = $request->grau;
            $prontuario->biomicoscopia = $request->biomicoscopia;
            $prontuario->qp = $request->qp;
            $prontuario->conduta = $request->conduta;
            $prontuario->descricao = $request->descricao;
            $prontuario->save();
        });

        return redirect()->route('prontuarios.list');
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

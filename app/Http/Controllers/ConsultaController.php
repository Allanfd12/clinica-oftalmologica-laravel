<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Consulta;
use App\Models\Pessoa;
use App\Models\Endereco;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        

        $consultaCount = Consulta::from('consultas')
        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
        ->join('users', 'medicos.users_id', '=', 'users.id')
        ->join('pessoas', function ($join) use ($search) {
            $join->on('pacientes.pessoa_id', '=', 'pessoas.id')
                ->orWhere('users.pessoa_id', '=', 'pessoas.id')
                ->where('pessoas.nome', 'like', "%{$search}%");
        })
        ->select('consultas.id')
        ->count();

        $consultas = Consulta::from('consultas')
            ->orderByRaw('DATE(data_consulta) DESC, hora_consulta DESC')
            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->join('users', 'medicos.users_id', '=', 'users.id')
            ->join('pessoas', function ($join) use ($search){
                $join->on('pacientes.pessoa_id', '=', 'pessoas.id')
                    ->orWhere('users.pessoa_id', '=', 'pessoas.id')
                    ->where('pessoas.nome', 'like', "%{$search}%");
            })
            ->select('consultas.*', 'consultas.id')
            ->paginate(10)->withQueryString();

        $consultas->total($consultaCount);

        foreach ($consultas as $consulta) {
            $consulta->data_consulta_formatted = Carbon::createFromFormat('Y-m-d', $consulta->data_consulta)->format('d/m/Y');

            $horaConsulta = substr($consulta->hora_consulta, 0, 5); // Extrai os primeiros 5 caracteres (hora:minuto)
            $consulta->hora_consulta_formatted = $horaConsulta;
        }

        return view('consultas.list', ['consultas'=> $consultas, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultas.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StorePacienteRequest $request)
    // {
    //     // dd($request->all());
    //     //  dd(Carbon::parse($request->data_nacimento)->format('m/d/Y'));
    //     $request->validated();
    //     DB::transaction(function () use ($request) {

    //         $endereco = new \App\Models\Endereco();

    //         $endereco->rua = $request->rua;
    //         $endereco->numero = $request->numero;
    //         $endereco->bairro = $request->bairro;
    //         $endereco->cidade = $request->cidade;
    //         $endereco->estado = $request->estado;
    //         $endereco->cep = $request->cep;
    //         $endereco->complemento = $request->complemento;
    //         $endereco->save();

    //         $pessoa = new Pessoa();
    //         $pessoa->nome = $request->nome;
    //         // remove caracteres especiais
    //         $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);

    //         $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');;
    //         $pessoa->email = $request->email;
    //         $pessoa->telefone = $request->telefone;
    //         $pessoa->endereco_id = $endereco->id;
    //         $pessoa->save();

    //         $paciente = new Paciente();
    //         $paciente->pessoa_id = $pessoa->id;
    //         $paciente->save();
    //     });
    //     return redirect()->route('pacientes.list');
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);
        $paciente = $consulta->paciente;
        $medico = $consulta->medico;
        
        return view('consultas.visualizar', compact('consulta', 'paciente', 'medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);
        $paciente = $consulta->paciente;
        $medico = $consulta->medico;

        return view('consultas.editar', compact('consulta', 'paciente', 'medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdatePacienteRequest $request, $id)
    // {
        
    //     DB::beginTransaction();

    //     $paciente = Paciente::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);

    //     $endereco = $paciente->pessoa->endereco;

    //     $endereco->rua = $request->rua;
    //     $endereco->numero = $request->numero;
    //     $endereco->bairro = $request->bairro;
    //     $endereco->cidade = $request->cidade;
    //     $endereco->estado = $request->estado;
    //     $endereco->cep = $request->cep;
    //     $endereco->complemento = $request->complemento;
    //     $endereco->save();

    //     $pessoa = $paciente->pessoa;

    //     $pessoa->nome = $request->nome;
    //     $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
    //     $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');
    //     $pessoa->email = $request->email;
    //     $pessoa->telefone = $request->telefone;
    //     $pessoa->save();
    //     $paciente->save();

    //     DB::commit();

    //     return redirect()->route('pacientes.list');

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consultas.list')->with('success', 'Consulta deletada com sucesso!');
    }

}

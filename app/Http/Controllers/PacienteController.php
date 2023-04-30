<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Pessoa;
use App\Models\Endereco;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        $pacientes = Paciente::join('pessoas', 'pacientes.pessoa_id', '=', 'pessoas.id')
            ->select('pacientes.*', 'pessoas.nome')
            ->where('pessoas.nome', 'like', "%{$search}%")
            ->paginate(10)->withQueryString();

        return view('pacientes.list',['pacientes'=> $pacientes, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pacientes.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacienteRequest $request)
    {
        // dd($request->all());
        //  dd(Carbon::parse($request->data_nacimento)->format('m/d/Y'));
        $request->validated();
        DB::transaction(function () use ($request) {

            $endereco = new \App\Models\Endereco();

            $endereco->rua = $request->rua;
            $endereco->numero = $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cidade = $request->cidade;
            $endereco->estado = $request->estado;
            $endereco->cep = $request->cep;
            $endereco->complemento = $request->complemento;
            $endereco->save();

            $pessoa = new Pessoa();
            $pessoa->nome = $request->nome;
            // remove caracteres especiais
            $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);

            $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');;
            $pessoa->email = $request->email;
            $pessoa->telefone = $request->telefone;
            $pessoa->endereco_id = $endereco->id;
            $pessoa->save();

            $paciente = new Paciente();
            $paciente->pessoa_id = $pessoa->id;
            $paciente->save();
        });
        return redirect()->route('pacientes.list');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paciente = Paciente::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);
        return view('pacientes.visualizar', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente = Paciente::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);
       // dd($paciente->pessoa->endereco->rua);

        return view('pacientes.editar', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, $id)
    {
        
        DB::beginTransaction();

        $paciente = Paciente::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);

        $endereco = $paciente->pessoa->endereco;

        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->cep = $request->cep;
        $endereco->complemento = $request->complemento;
        $endereco->save();

        $pessoa = $paciente->pessoa;

        $pessoa->nome = $request->nome;
        $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;
        $pessoa->save();
        $paciente->save();

        DB::commit();

        return redirect()->route('pacientes.list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $paciente = Paciente::findOrFail($id);
    $paciente->delete();

    return redirect()->route('pacientes.list')->with('success', 'Paciente deletado com sucesso!');
}

}

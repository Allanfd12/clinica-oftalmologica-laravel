<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Pessoa;
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
            ->select('pacientes.*', 'pessoas.*')
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

            $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');
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
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}

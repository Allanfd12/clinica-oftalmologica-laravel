<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;
use App\Models\Pessoa;
use App\Models\Endereco;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        $medicos = Medico::join('users', 'users.id', '=', 'medicos.users_id')
            ->join('pessoas', 'users.pessoa_id', '=', 'pessoas.id')
            ->select('medicos.*', 'pessoas.nome')
            ->where('pessoas.nome', 'like', "%{$search}%")
            ->orWhere('medicos.crm', 'like', "%{$search}%")
            ->orWhere('medicos.especialidade', 'like', "%{$search}%")
            ->paginate(10)->withQueryString();

        return view('medicos.list',['medicos'=> $medicos, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicos.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicoRequest $request)
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

            $medico = new Medico();
            $medico->pessoa_id = $pessoa->id;
            $medico->save();
        });
        return redirect()->route('medicos.list');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medico = Medico::with(['user', 'user.pessoa','user.pessoa.endereco'])->findOrFail($id);
        //dd($medico );
        return view('medicos.visualizar', compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medico = Medico::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);
       // dd($medico->pessoa->endereco->rua);

        return view('medicos.editar', compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicoRequest $request, $id)
    {
        
        DB::beginTransaction();

        $medico = Medico::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);

        $endereco = $medico->pessoa->endereco;

        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->cep = $request->cep;
        $endereco->complemento = $request->complemento;
        $endereco->save();

        $pessoa = $medico->pessoa;

        $pessoa->nome = $request->nome;
        $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;
        $pessoa->save();
        $medico->save();

        DB::commit();

        return redirect()->route('medicos.list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $medico = Medico::findOrFail($id);
    $medico->delete();

    return redirect()->route('medicos.list')->with('success', 'Medico deletado com sucesso!');
}

}

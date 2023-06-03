<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            ->orderBy('pessoas.nome', 'asc')
            ->paginate(10)->withQueryString();

        return view('medicos.list',['medicos'=> $medicos, 'search' => $search]);
    }

    public function search(Request $request)
    {
        $term = $request->input('searchItemMedico');
    
        // Realize a lógica de busca de pacientes com base no termo e na página fornecidos.
        // Você pode usar um modelo Eloquent ou qualquer outra lógica de busca personalizada.
    
        $medicos = Medico::join('users', 'users.id', '=', 'medicos.users_id')
            ->join('pessoas', 'users.pessoa_id', '=', 'pessoas.id')
            ->where('pessoas.nome', 'like', '%' . $term . '%')
            ->orderBy('pessoas.nome')
            ->paginate(10);
    
        // Formate os resultados no formato esperado pelo Select2.
        $formattedResults = [];
        foreach ($medicos as $medico) {
            $formattedResults[] = [
                'id' => $medico->id,
                'text' => $medico->pessoa->nome,
            ];
        }
    
        // Retorne os resultados formatados como JSON.
        return response()->json([
            'data' => $formattedResults,
            'last_page' => $medicos->lastPage(),
        ]);
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

            $usuario = new User();
            $usuario->pessoa_id = $pessoa->id;
            $usuario->name = $pessoa->nome;
            $usuario->email = $pessoa->email;
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            $medico = new Medico();
            $medico->users_id = $usuario->id;
            $medico->crm = $request->crm;
            $medico->especialidade = $request->especialidade;

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
        return view('medicos.visualizar', compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $medico = Medico::with(['user', 'user.pessoa','user.pessoa.endereco'])->findOrFail($id);

        return view('medicos.editar', compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicoRequest $request, $id)
    {
        
        DB::beginTransaction();

        $medico = Medico::with(['user', 'user.pessoa','user.pessoa.endereco'])->findOrFail($id);
        
        $endereco = $medico->user->pessoa->endereco;

        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->bairro = $request->bairro;
        $endereco->cidade = $request->cidade;
        $endereco->estado = $request->estado;
        $endereco->cep = $request->cep;
        $endereco->complemento = $request->complemento;
        $endereco->save();

        $pessoa = $medico->user->pessoa;
        $pessoa->nome = $request->nome;
        $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');;
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;
        $pessoa->save();

        $usuario = $medico->user;
        $usuario->name = $pessoa->nome;
        $usuario->email = $pessoa->email;
        
        if($request->password != null){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        $medico->crm = $request->crm;
        $medico->especialidade = $request->especialidade;

        $medico->save();

        DB::commit();

        return redirect()->route('medicos.list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $medico = Medico::with(['user', 'user.pessoa','user.pessoa.endereco'])->findOrFail($id);
    DB::beginTransaction();
    $medico->delete();
    $medico->user->delete();
    $medico->user->pessoa->delete();
    $medico->user->pessoa->endereco->delete();
    DB::commit();

    return redirect()->route('medicos.list')->with('success', 'Medico deletado com sucesso!');
}

}

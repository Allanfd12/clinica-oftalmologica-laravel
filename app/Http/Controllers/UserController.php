<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        $users = User::from('users as u')
            ->join('pessoas as p', 'u.pessoa_id', '=', 'p.id')
            ->select('u.*', 'p.*')
            ->where('p.nome', 'like', "%{$search}%")
            ->orWhere('u.email', 'like', "%{$search}%")
            ->paginate(10)->withQueryString();

            return view('usuarios.list',['usuarios'=> $users, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // $request->validated();
        // DB::transaction(function () use ($request) {

        //     $endereco = new \App\Models\Endereco();


        //     $endereco->rua = $request->rua;
        //     $endereco->numero = $request->numero;
        //     $endereco->bairro = $request->bairro;
        //     $endereco->cidade = $request->cidade;
        //     $endereco->estado = $request->estado;
        //     $endereco->cep = $request->cep;
        //     $endereco->complemento = $request->complemento;
        //     $endereco->save();

        //     $pessoa = new Pessoa();
        //     $pessoa->nome = $request->nome;
        //     // remove caracteres especiais
        //     $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);

        //     $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');;
        //     $pessoa->email = $request->email;
        //     $pessoa->telefone = $request->telefone;
        //     $pessoa->endereco_id = $endereco->id;
        //     $pessoa->save();    
        // });
        // return redirect()->route('pacientes.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

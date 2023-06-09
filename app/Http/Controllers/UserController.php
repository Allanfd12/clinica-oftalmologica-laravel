<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Pessoa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            ->select('u.*', 'p.nome')
            ->where('p.nome', 'like', "%{$search}%")
            ->orWhere('u.email', 'like', "%{$search}%")
            ->orderBy('p.nome')
            ->paginate(10)->withQueryString();

            foreach ($users as $user) {
                $cpf = preg_replace('/[^0-9]/', '', $user->pessoa->cpf);
                $cpf_formatado = substr($cpf, 0, 3).'.'.substr($cpf, 3, 3).'.'.substr($cpf, 6, 3).'-'.substr($cpf, 9);
                $user->pessoa->cpf_formatted = $cpf_formatado;
            }
            

        return view('usuarios.list', ['usuarios' => $users, 'search' => $search]);
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
        $request->validated();
        DB::transaction(function () use ($request) {

            $pessoa = new Pessoa();
            $pessoa->nome = $request->nome;
            //remove caracteres especiais
            $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);

            $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');;
            $pessoa->email = $request->email;
            $pessoa->telefone = $request->telefone;
            $pessoa->save();

            $usuario = new User();
            $usuario->pessoa_id = $pessoa->id;
            $usuario->name = $pessoa->nome;
            $usuario->email = $pessoa->email;
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        });

        return redirect()->route('usuarios.list');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with('pessoa')->findOrFail($id);
        return view('usuarios.visualizar', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $user = User::with('pessoa')->findOrFail($id);

        return view('usuarios.editar', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();

        $usuario = User::findOrFail($id);
        $pessoa = $usuario->pessoa;

        $pessoa->nome = $request->nome;
        $pessoa->cpf = preg_replace('/[^0-9]/', '', $request->cpf);
        $pessoa->data_nacimento = Carbon::parse($request->data_nacimento)->format('Y-m-d');
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;
        $pessoa->save();

        $usuario->name = $pessoa->nome;
        $usuario->email = $pessoa->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        DB::commit();

        return redirect()->route('usuarios.list');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = User::with('pessoa')->findOrFail($id);
        $registro->delete();

        return redirect()->route('usuarios.list');
    }
}

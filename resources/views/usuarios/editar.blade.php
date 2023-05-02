@extends('layouts.public')

@section('title', 'Ophtamuls - Usuários')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Usuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Edite os dados do usuário
        </h4>
        <div class="card-body">
            <form action="{{ route('usuarios.atualizar', $user->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" value="{{ $user->pessoa->nome }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="cpf" value="{{ $user->pessoa->cpf }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nacimento" value="{{ \Carbon\Carbon::parse($user->pessoa->data_nacimento)->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->pessoa->email }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="telefone" value="{{ $user->pessoa->telefone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <input type="text" class="form-control" name="password" >
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Confirmar Senha</label>
                        <input type="text" class="form-control" name="password" >
                    </div>
                </div>
                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Salvar</button>
            </form>
        </div>
    </div>
@endsection
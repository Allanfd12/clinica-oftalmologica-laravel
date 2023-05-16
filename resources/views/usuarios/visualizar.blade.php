@extends('layouts.public')

@section('title', 'Ophtamuls - Usuários')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Ver Usuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Visualize os dados do usuário
        </h4>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required value="{{ $user->pessoa->nome }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required value="{{ $user->pessoa->cpf }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nacimento" min="1900-01-01" max="{{date('Y-m-d')}}" required value="{{ \Carbon\Carbon::parse($user->pessoa->data_nacimento)->format('Y-m-d') }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control email" name="email" value="{{ $user->pessoa->email }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control telefone" name="telefone" required value="{{ $user->pessoa->telefone }}" disabled>
                    </div>
                </div>

                <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('usuarios.list') }}">Voltar</a>
        </div>
    </div>
@endsection

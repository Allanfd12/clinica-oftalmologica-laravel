@extends('layouts.public')

@section('title', 'Ophtamuls - Usuários')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Criar Usuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Preencha os dados do novo usuário
        </h4>
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST" style="display: inline;">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label required">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required >
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label required">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" >
                        <div class="message-cpf"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label required">Data de Nascimento</label>
                        <input type="date" class="form-control data_nacimento" name="data_nacimento" required>
                        <div class="message-data-nascimento"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label required">E-mail</label>
                        <input type="email" class="form-control email" name="email" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label required">Telefone</label>
                        <input type="tel" class="form-control telefone" name="telefone" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label required">Senha</label>
                        <input type="password" class="form-control password" name="password" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label required">Confirmar Senha</label>
                        <input type="text" class="form-control confirm-password" name="confirm-password" required>
                        <div class="message-password"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('usuarios.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

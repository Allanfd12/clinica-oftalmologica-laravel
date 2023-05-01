@extends('layouts.public')

@section('title', 'Ophtamuls - Pacientes')

@section('content')
<h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Paciente</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Atualize os dados do paciente
        </h4>
        <div class="card-body">
            <form action="{{ route('pacientes.atualizar', $paciente -> id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" value="{{ $paciente->pessoa->nome }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="cpf" value="{{ $paciente->pessoa->cpf }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nacimento" value="{{ $paciente->pessoa->data_nacimento }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email"  value="{{ $paciente->pessoa->email }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="telefone"  value="{{ $paciente->pessoa->telefone }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" value="{{ $paciente->pessoa->endereco->rua }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" name="numero" value="{{ $paciente->pessoa->endereco->numero }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" value="{{ $paciente->pessoa->endereco->cep }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" value="{{ $paciente->pessoa->endereco->bairro }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" value="{{ $paciente->pessoa->endereco->cidade }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" name="estado" value="{{ $paciente->pessoa->endereco->estado }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" name="complemento" value="{{ $paciente->pessoa->endereco->complemento }}">
                    </div>
                </div>
                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Atualizar</button>
            </form>
        </div>
    </div>

@endsection

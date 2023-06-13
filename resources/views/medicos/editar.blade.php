@extends('layouts.public')

@section('title', 'Ophtamuls - Médicos')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Médico</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Edite os dados do Médico
        </h4>
        <div class="card-body">
            <form action="{{ route('medicos.atualizar', $medico->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label required">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required value="{{ $medico->user->pessoa->nome }}" >
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label required">Especialidade</label>
                        <input type="text" class="form-control" name="especialidade" required value="{{ $medico->especialidade }}" >
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label required">CRM</label>
                        <input type="text" class="form-control" name="crm" required value="{{ $medico->crm }}" >
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label required">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{ $medico->user->pessoa->cpf }}">
                        <input type="hidden" class="form-control idPessoa" name="id" value="{{ $medico->user->pessoa->id }}">
                        <div class="message-cpf"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label required">Data de Nascimento</label>
                        <input type="date" class="form-control data_nacimento" name="data_nacimento" min="1900-01-01" max="{{date('Y-m-d')}}" required value="{{ \Carbon\Carbon::parse($medico->user->pessoa->data_nacimento)->format('Y-m-d') }}" >
                        <div class="message-data-nascimento"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label required">E-mail</label>
                        <input type="email" class="form-control email" name="email" required value="{{ $medico->user->pessoa->email }}" >
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label required">Telefone</label>
                        <input type="tel" class="form-control telefone" name="telefone" required value="{{ $medico->user->pessoa->telefone }}" >
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label required">Rua</label>
                        <input type="text" class="form-control" name="rua" required value="{{ $medico->user->pessoa->endereco->rua }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label required">Número</label>
                        <input type="text" class="form-control" name="numero" required value="{{ $medico->user->pessoa->endereco->numero }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label required">CEP</label>
                        <input type="text" class="form-control cep" name="cep" required value="{{ $medico->user->pessoa->endereco->cep }}" >
                        <div class="message-cep"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label required">Bairro</label>
                        <input type="text" class="form-control" name="bairro" required value="{{ $medico->user->pessoa->endereco->bairro }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cidade" class="form-label required">Cidade</label>
                        <input type="text" class="form-control" name="cidade" required value="{{ $medico->user->pessoa->endereco->cidade }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label required">Estado</label>
                        <input type="text" class="form-control" name="estado" required value="{{ $medico->user->pessoa->endereco->estado }}" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label required">Complemento</label>
                        <input type="text" class="form-control" name="complemento" required value="{{ $medico->user->pessoa->endereco->complemento }}" >
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="confirm-password" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control confirm-password" name="confirm-password" />
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('medicos.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

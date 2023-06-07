@extends('layouts.public')

@section('title', 'Ophtamuls - Médicos')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Ver Médico</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Visualize os dados do Médico
        </h4>
        <div class="card-body">
                <div class="row">

                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required value="{{ $medico->user->pessoa->nome }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" name="especialidade" value="{{ $medico->especialidade }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CRM</label>
                        <input type="text" class="form-control" name="crm" value="{{ $medico->crm }}" disabled>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{ $medico->user->pessoa->cpf }}" disabled>
                        <div class="message-cpf"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nacimento" min="1900-01-01" max="{{date('Y-m-d')}}" required value="{{ \Carbon\Carbon::parse($medico->user->pessoa->data_nacimento)->format('Y-m-d') }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control email" name="email" value="{{ $medico->user->pessoa->email }}" disabled>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control telefone" name="telefone" required value="{{ $medico->user->pessoa->telefone }}" disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" value="{{ $medico->user->pessoa->endereco->rua }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" name="numero" value="{{ $medico->user->pessoa->endereco->numero }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep" value="{{ $medico->user->pessoa->endereco->cep }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" value="{{ $medico->user->pessoa->endereco->bairro }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" value="{{ $medico->user->pessoa->endereco->cidade }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" name="estado" value="{{ $medico->user->pessoa->endereco->estado }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" name="complemento" value="{{ $medico->user->pessoa->endereco->complemento }}" disabled>
                    </div>
                </div>
                <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('medicos.list') }}">Voltar</a>
        </div>
    </div>
@endsection

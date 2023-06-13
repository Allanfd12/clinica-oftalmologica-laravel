@extends('layouts.public')

@section('title', 'Ophtamuls - Pacientes')

@section('content')
<h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Criar Paciente</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Preencha os dados do novo paciente
        </h4>
        <div class="card-body">
            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label required">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required >
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label required">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" >
                        <div class="message-cpf"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label required">Data de Nascimento</label>
                        <input type="date" class="form-control data_nacimento" name="data_nacimento" min="1900-01-01" max="{{date('Y-m-d')}}" required >
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label required">Rua</label>
                        <input type="text" class="form-control" name="rua" required >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label required">Número</label>
                        <input type="text" class="form-control" name="numero" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label required">CEP</label>
                        <input type="text" class="form-control cep invalid-cep" name="cep" required>
                        <div class="message-cep"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label required">Bairro</label>
                        <input type="text" class="form-control" name="bairro" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cidade" class="form-label required">Cidade</label>
                        <input type="text" class="form-control" name="cidade" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label required">Estado</label>
                        <input type="text" class="form-control" name="estado" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label required">Complemento</label>
                        <input type="text" class="form-control" name="complemento" required>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('pacientes.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

@endsection

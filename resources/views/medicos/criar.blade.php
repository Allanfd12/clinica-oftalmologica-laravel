@extends('layouts.public')

@section('title', 'Ophtamuls - Médicos')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Criar Médico</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Preencha os dados do novo Médico
        </h4>
        <div class="card-body">
            <form action="{{ route('medicos.store') }}" method="POST" style="display: inline;">
                @csrf
                <div class="row">

                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required />
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Especialidade</label>
                        <input type="text" class="form-control" name="especialidade" required/>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CRM</label>
                        <input type="text" class="form-control" name="crm" maxlength="20" required/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" >
                        <div class="message-cpf"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="data_nacimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control data_nacimento" name="data_nacimento" min="1900-01-01" max="{{date('Y-m-d')}}" required />
                        <div class="message-data-nascimento"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control email" name="email" required/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control telefone" name="telefone" required />
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua" required/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" name="numero" required/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control cep" name="cep" required/>
                        <div class="message-cep"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro" required/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cidade" required/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" name="estado" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" name="complemento" required/>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-3 border-bottom"></div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control password" name="password" required/>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="complemento" class="form-label">Confirmar Senha</label>
                        <input type="confirm-password" class="form-control confirm-password" name="confirm-password" required/>
                        <div class="message-password"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('medicos.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

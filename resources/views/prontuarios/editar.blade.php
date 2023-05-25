@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuário')

@section('content')
<h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Paciente</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Atualize os dados do Prontuário
        </h4>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Paciente</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" value="{{ $prontuario->pessoa->nome }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required value="{{ $prontuario->cpf }}">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control form-control-lg" name="descricao"  value="{{ $prontuario->descricao }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="telefone" class="form-label">Queixa Principal</label>
                        <input type="text" class="form-control" name="rua" required  value="{{ $prontuario->qp }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="rua" class="form-label">Conduta</label>
                        <input type="text" class="form-control" name="rua" value="{{ $prontuario->conduta }}">
                    </div>
                </div>

                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Atualizar</button>
            </form>
        </div>
    </div>

@endsection

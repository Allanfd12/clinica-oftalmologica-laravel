@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuário')

@section('content')
<h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Visualizar Prontuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Visualize os Dados Completos do Prontuário
        </h4>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="paciente" class="form-label">Paciente</label>
                        <input type="text" class="form-control" name="paciente" maxlength="255" value="{{ $prontuario->paciente->pessoa->nome }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required value="{{ $prontuario->paciente->pessoa->cpf }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao"  value="{{ $prontuario->descricao }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="grau" class="form-label">Grau</label>
                        <input type="text" class="form-control" name="grau" value="{{ $prontuario->grau }}" required disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="biomicoscopia" class="form-label">Biomicoscopia</label>
                        <input type="text" class="form-control" name="biomicoscopia" required value="{{ $prontuario->biomicoscopia }}" disabled>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="qp" class="form-label">Queixa Principal</label>
                        <input type="text" class="form-control" name="qp" required  value="{{ $prontuario->qp }}" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="conduta" class="form-label">Conduta</label>
                        <input type="text" class="form-control" name="conduta" value="{{ $prontuario->conduta }}" disabled>
                    </div>
                </div>
                
                <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('prontuarios.list') }}">Voltar</a>
        </div>
    </div>

@endsection

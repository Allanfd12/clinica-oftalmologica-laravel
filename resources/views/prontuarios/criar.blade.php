@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuários')

@section('content')
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Criar Prontuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Preencha os dados do prontuário
        </h4>
        <div class="card-body">
            <form action="#" method="POST" style="display: inline;">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="name" class="form-label">Paciente</label>
                        
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="grau" class="form-label">Grau</label>
                        <input type="text" class="form-control" name="grau" required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="biomicoscopia" class="form-label">Biomicoscopia</label>
                        <input type="text" class="form-control" name="biomicoscopia" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="qp" class="form-label">Queixa Principal</label>
                        <input type="text" class="form-control" name="qp" required>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="conduta" class="form-label">Conduta</label>
                        <input type="text" class="form-control" name="conduta" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao" required>
                    </div>
                </div>
                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Salvar</button>
            </form>
        </div>
    </div>
@endsection

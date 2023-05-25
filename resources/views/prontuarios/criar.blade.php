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
                        <select class="form-select" name="paciente_id" required>
                            <option value="" selected disabled hidden>Selecione um paciente</option>
                            @foreach($prontuarios as $prontuario)
                                <option value="{{$prontuario->id}}">{{$prontuario->nome}}</option>
                            @endforeach
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" name="cpf" required >
                    </div>
                </div>
                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Salvar</button>
            </form>
        </div>
    </div>
@endsection

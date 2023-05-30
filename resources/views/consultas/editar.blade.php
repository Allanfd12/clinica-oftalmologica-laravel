@extends('layouts.public')

@section('title', 'Ophtamuls - Pacientes')

@section('content')
<h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Consulta</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Atualize os dados da consulta
        </h4>
        <div class="card-body">
            <form action="{{ route('consultas.editar') }}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Paciente</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required >
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Médico</label>
                        <input type="text" class="form-control" name="nome" maxlength="255" required >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Data da consulta</label>
                        <input type="date" class="form-control" name="data" required >
                    </div>
                </div>
                <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Atualizar</button>
            </form>
        </div>
    </div>

@endsection

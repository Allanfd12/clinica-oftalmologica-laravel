@extends('layouts.public')

@section('title', 'Ophtamuls - Pacientes')

@section('content')       
    <h1 style="text-align: left; margin-top: 2%; margin-left: 5%; color: #20B2AA">Pacientes</h1>
    <hr style="margin: 5%; margin-top: 2%"class="linha-home">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{$paciente->nome}}</td>
                            <td><a href="">Editar</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

   
@endsection
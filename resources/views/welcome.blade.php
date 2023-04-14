@extends('layouts.public')

@section('content')
    <div>
        <div>
            <div>
                <hr class="linha-home">
                <h1 style="text-align: center; margin-top: 5%; margin-bottom: 5%"><img style="max-width:90px; max-height:90px;" src="{{ asset('img/olho-logo.png') }}" alt="Logo" width="auto" height="auto" > Sistema <span style="color: #20B2AA">Oftamológico</span></h1>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <button class="btn btn-primary">Fazer Consulta</button>
                </div>
                <hr class="linha-home">
            </div>
        </div>
    </div>
@endsection
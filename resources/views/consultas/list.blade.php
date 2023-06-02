@extends('layouts.public')

@section('title', 'Ophtamuls - Consultas')

@section('content')       
    <h2 style="text-align: left; margin-top: 2%; margin-left: 5%; color: #20B2AA">Consultas</h2>
    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;"class="linha-home">

    <div class="card" style="width: 90%; margin-left: 5%">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            <a href="{{ 'consultas/criar '}}" class="btn btn-light"><span class="material-symbols-outlined" style="vertical-align: bottom">add</span> Nova Consulta</a>
            <form class="d-flex" role="search" action="{{route('consultas.list')}}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" name='search' value="">
                <button class="btn btn-light" type="submit"><span class="material-symbols-outlined" style="vertical-align: bottom">
                search
                </span></button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-hover text-center align-middle table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Médico</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($consultas as $consulta)
                <tr>
                    <td scope="row">{{$consulta->id}}</td>
                    <td scope="row">{{$consulta->medico->user->name}}</td>
                    <td scope="row">{{$consulta->paciente->pessoa->nome}}</td>
                    <td>
                        <a href="{{ route('consultas.editar', $consulta -> id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">edit_square</span></a>
                        <a href="{{ route('consultas.visualizar', $consulta -> id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">visibility</span></a>
                        <a type="button" class="link-secondary" data-bs-toggle="modal" data-bs-target="#idModal{{ $consulta->id }}"><span class="material-symbols-outlined fs-4">delete</span></a>

                    <!-- Modal -->
                        <div class="modal fade" id="idModal{{ $consulta->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Paciente</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <p>Tem certeza que deseja excluir a consulta {{ $consulta->id }} ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <a type="button" class="btn btn-danger" href="{{ route('consultas.excluir', $consulta->id) }}">Excluir</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        {{-- <form method="POST" id='delete_form' action=""  style="display: inline" >
                            @csrf
                            @method('DELETE')
                            <a href="javascript:{}" onclick="confirm('Are you sure?') ? document.getElementById('delete_form').submit():null; return false;" class="link-secondary"><span class="material-symbols-outlined fs-4">
                                delete
                                </span></a>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
                
            
                </tbody>
            </table>
            {{ $consultas->onEachSide(2)->links('layouts.pagination') }}
        </div>
    </div>

    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;"class="linha-home">



@endsection
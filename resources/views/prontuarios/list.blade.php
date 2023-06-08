@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuários')

@section('content')
    <h2 style="text-align: left; margin-top: 2%; margin-left: 5%; color: #20B2AA">Prontuários</h2>
    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;" class="linha-home">

    <div class="card" style="width: 90%; margin-left: 5%">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            <a href="{{ route('prontuarios.criar') }}" class="btn btn-light"><span class="material-symbols-outlined" style="vertical-align: bottom">add</span> Novo Prontuário</a>
            <form class="d-flex" role="search" action="{{route('prontuarios.list')}}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" name='search' value="{{$search}}">
                <button class="btn btn-light" type="submit"><span class="material-symbols-outlined" style="vertical-align: bottom">
                search
                </span></button>
            </form>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover text-center align-middle table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="text-align: left; padding-left: 40px">Paciente</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Última Alteração</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prontuarios as $prontuario)
                <tr>
                    <td style="text-align: left; padding-left: 40px; width: 350px">{{$prontuario->nome}}</td>
                    <td>{{$prontuario->paciente->pessoa->cpf_formatted}}</td>
                    <td>{{$prontuario->updated_at_formatted}}</td>
                    <td>
                        <a href="{{ route('prontuarios.editar', $prontuario -> id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">edit_square</span></a>
                        <a href="{{ route('prontuarios.visualizar', $prontuario -> id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">visibility</span></a>
                        <a type="button" class="link-secondary" data-bs-toggle="modal" data-bs-target="#idModal{{ $prontuario->id }}"><span class="material-symbols-outlined fs-4">delete</span></a>

                        <!-- Modal -->
                        <div class="modal fade" id="idModal{{ $prontuario->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Prontuário</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <p>Tem certeza que deseja excluir o prontuário do paciente {{$prontuario->nome}} ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <a type="button" class="btn btn-danger" href="{{ route('prontuarios.excluir', $prontuario->id) }}">Excluir</a>
                                </div>
                              </div>
                            </div>
                        </div>
                </tr>
                @endforeach
                
            
                </tbody>
            </table>
            {{ $prontuarios->onEachSide(2)->links('layouts.pagination') }}
        </div>
        
    </div>

    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;" class="linha-home">

@endsection
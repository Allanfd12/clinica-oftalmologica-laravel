@extends('layouts.public')

@section('title', 'Ophtamuls - Médicos')

@section('content')
    <h2 style="text-align: left; margin-top: 2%; margin-left: 5%; color: #20B2AA">Médicos</h2>
    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;" class="linha-home">

    <div class="card" style="width: 90%; margin-left: 5%">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            <a href="{{ route('medicos.criar') }}" class="btn btn-light"><span class="material-symbols-outlined" style="vertical-align: bottom">add</span> Novo Médico</a>
            <form class="d-flex" role="search" action="{{route('medicos.list')}}" method="GET">
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
                        <th class="col-1" scope="col">ID</th>
                        <th class="col-4" scope="col">Nome</th>
                        <th class="col-3" scope="col">Especialidade</th>
                        <th class="col-2" scope="col">Crm</th>
                        <th class="col-2" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicos as $medico)
                <tr>
                    <th scope="row">{{$medico->id}}</th>
                    <td>{{$medico->nome}}</td>
                    <td>{{$medico->especialidade}}</td>
                    <td>{{$medico->crm}}</td>
                    <td>
                        <a href="{{ route('medicos.editar', $medico->id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">edit_square</span></a>
                        <a href="{{ route('medicos.visualizar', $medico->id) }}" class="link-secondary"><span class="material-symbols-outlined fs-4">visibility</span></a>
                        <a type="button" class="link-secondary" data-bs-toggle="modal" data-bs-target="#idModal{{ $medico->id }}"><span class="material-symbols-outlined fs-4">delete</span></a>

                        <!-- Modal -->
                        <div class="modal fade" id="idModal{{ $medico->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Médico</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <p>Tem certeza que deseja excluir o Médico {{$medico->nome}} ?</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <a type="button" class="btn btn-danger" href="{{ route('medicos.excluir', $medico->id) }}">Excluir</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        
                    </td>
                </tr>
                @endforeach
                
            
                </tbody>
            </table>
            {{ $medicos->onEachSide(2)->links('layouts.pagination') }}
        </div>
        
    </div>
    {{-- <button >
        Launch static backdrop modal
    </button> --}}
    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%; width: 90%;" class="linha-home">
<script>

//     console.log('oasai');

//     var myModal = new bootstrap.Modal('#modal_delete');
    
//     myModal.show();
// </script>
    
@endsection
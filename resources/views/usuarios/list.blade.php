@extends('layouts.public')

@section('title', 'Ophtamuls - Usuários')

@section('content')
    <h2 style="text-align: left; margin-top: 2%; margin-left: 5%; color: #20B2AA">Usuários</h2>
    <hr style="margin-left: 5%; margin-top: 1%; margin-bottom: 1%"class="linha-home">

    <div class="card" style="width: 90%; margin-left: 5%">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            <a href="#" class="btn btn-light"><span class="material-symbols-outlined" style="vertical-align: bottom">add</span> Novo Usuário</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2 " type="search" placeholder="Pesquisar" aria-label="Search">
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
                        <th scope="col">Login</th>
                        <th scope="col">Email</th>
                        <th scope="col">Permissões</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->nome}}</td>
                    <td>{{$user->email}}</td>
                    <td>Todas</td>
                    <td>
                        <a href="#" class="link-secondary"><span class="material-symbols-outlined fs-4">edit_square</span></a>
                        <a href="#" class="link-secondary"><span class="material-symbols-outlined fs-4">
                            visibility
                            </span></a>
                        <a href="#" class="link-secondary"><span class="material-symbols-outlined fs-4">
                            delete
                            </span></a>
                    </td>
                </tr>
                @endforeach
                
            
                </tbody>
            </table>
            {{ $usuarios->onEachSide(2)->links('layouts.pagination') }}
        </div>
        
    </div>
    
@endsection
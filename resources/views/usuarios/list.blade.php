@extends('layouts.public')

@section('title', 'Ophtamuls - Usuários')

@section('content')
    <h1 style="text-align: left; margin-top: 3%; margin-left: 5%; color: #20B2AA">Usuários</h1>
    <hr style="margin-left: 5%; margin-top: 2%; margin-bottom: 3%"class="linha-home">

    <div class="card" style="width: 90%; margin-left: 5%">
        <h5 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Lista de Usuários
            <a href="#" class="btn btn-light"><span class="material-symbols-outlined" style="vertical-align: bottom">add</span> Novo Usuário</a>
        </h5>
        <div class="card-body">
            <table class="table table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Login</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Permissões</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>sergio</td>
                    <td>senha</td>
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
                <tr>
                    <th scope="row">2</th>
                    <td>allan</td>
                    <td>senha</td>
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
                <tr>
                    <th scope="row">3</th>
                    <td>fernanda</td>
                    <td>senha</td>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
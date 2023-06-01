@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuários')

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>

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
                        <select id="ajaxselect" class="js-states form-control">
                        </select>
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

    <script>
        var pacientesSearchUrl = '{{ route('pacientes.search') }}';

        $(document).ready(function() {
            $('#ajaxselect').select2({
                placeholder: "Selecione um Paciente",
                ajax: {
                    url: pacientesSearchUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchItem: params.term,
                            page: params.page,
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.data,
                            pagination: {
                                more: data.last_page != params.page
                            }
                        }
                    },
                    cache: true
                }
            });

        });
    </script>
@endsection

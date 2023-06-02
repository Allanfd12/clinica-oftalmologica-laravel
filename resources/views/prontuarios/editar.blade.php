@extends('layouts.public')

@section('title', 'Ophtamuls - Prontuário')

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>

    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Editar Prontuário</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Atualize os dados do Prontuário
        </h4>
        <div class="card-body">
            <form action="{{ route('prontuarios.atualizar', $prontuario->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="paciente" class="form-label">Paciente</label>
                        <select id="ajaxselect" class="js-states form-control">
                            <option selected>{{ $prontuario->paciente->pessoa->nome }}</option>
                        </select>
                        <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $prontuario->paciente_id }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="grau" class="form-label">Grau</label>
                        <input type="text" class="form-control" name="grau" value="{{ $prontuario->grau }}" required>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="biomicoscopia" class="form-label">Biomicoscopia</label>
                        <input type="text" class="form-control" name="biomicoscopia" required value="{{ $prontuario->biomicoscopia }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="qp" class="form-label">Queixa Principal</label>
                        <input type="text" class="form-control" name="qp" required  value="{{ $prontuario->qp }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="conduta" class="form-label">Conduta</label>
                        <input type="text" class="form-control" name="conduta" value="{{ $prontuario->conduta }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao"  value="{{ $prontuario->descricao }}">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('prontuarios.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var pacientesSearchUrl = '{{ route('pacientes.search') }}';
        var pacientesFindId = '{{ route('pacientes.findId') }}';

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
        
        $('#ajaxselect').on('change', function() {
            var selectedPessoaId = $(this).val();

            // Fazer uma requisição AJAX para obter o paciente_id correspondente ao pessoa_id selecionado
            $.ajax({
                url: pacientesFindId,
                method: 'GET',
                data: { pessoaId: selectedPessoaId },
                success: function(response) {
                    var selectedPacienteId = response.pacienteId;

                    // Atribuir o ID do paciente ao campo pacienteId do formulário
                    $('#paciente_id').val(selectedPacienteId);
                },
                error: function() {
                    alert('Erro ao obter o ID do paciente.');
                }
            });
        });
    </script>
@endsection

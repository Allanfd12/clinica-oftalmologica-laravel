@extends('layouts.public')

@section('title', 'Ophtamuls - Consultas')

@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </head>
    <h2 style="text-align: center; margin-top: 2%; color: #20B2AA">Criar Consulta</h2>
    <hr style="margin-top: 1%; margin-bottom: 1%;" class="linha-home">

    <div class="card" style="width: 90%; margin: auto">
        <h4 class="card-header d-flex justify-content-between align-items-center" style="background-color:#20B2AA; color: white;">
            Preencha os dados da consulta
        </h4>
        <div class="card-body">
            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Paciente</label>
                        <select id="ajaxselectPaciente" class="js-states form-control">
                        </select>
                        <input type="hidden" id="paciente_id" name="paciente_id" value="">
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Médico</label>
                        <select id="ajaxselectMedico" class="js-states form-control">
                        </select>
                        <input type="hidden" id="medico_id" name="medico_id" value="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Data da consulta</label>
                        <input type="date" class="form-control" name="data_consulta" required >
                    </div>
                    <div class="col-md-4 mb-4" >
                        <label for="nome" class="form-label">Hora da consulta</label>
                        <input type="time" class="form-control" name="hora_consulta" required >
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary d-grid gap-2 col-3 mx-auto" href="{{ route('consultas.list') }}">Voltar</a>
                    <button class="btn btn-primary d-grid gap-2 col-3 mx-auto" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        var pacientesSearchUrl = '{{ route('pacientes.search') }}';
        var pacientesFindId = '{{ route('pacientes.findId') }}';

        var medicosSearchUrl = '{{ route('medicos.search') }}';

        $(document).ready(function() {
            $('#ajaxselectPaciente').select2({
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

            $('#ajaxselectMedico').select2({
                placeholder: "Selecione um Médico",
                ajax: {
                    url: medicosSearchUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchItemMedico: params.term,
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
        
        $('#ajaxselectPaciente').on('change', function() {
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

@section('title', 'Ophtamuls - Pacientes')
<div class="container mt-5">
    <h1>Cadastro de Pacientes</h1>
    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" >
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" name="telefone" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" name="rua" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control" name="numero" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" name="cep" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" name="cidade" >
            </div>
            <div class="col-md-4 mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" name="estado" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="complemento" class="form-label">Complemento</label>
                <input type="text" class="form-control" name="complemento">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Cadastrar</button>
    </form>
</div>
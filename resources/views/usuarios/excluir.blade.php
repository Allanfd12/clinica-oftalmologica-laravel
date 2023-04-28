<form method="POST" action="{{ route('usuarios.excluir', ['id' => $user->id]) }}">
    @csrf
    <p>Tem certeza que deseja excluir o registro?</p>
    <button type="submit">Sim</button>
    <a href="{{ route('usuarios.list') }}">Não</a>
</form>

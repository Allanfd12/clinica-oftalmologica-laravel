
    <!-- Full screen modal -->
<div>
    <form method="POST" action="{{ route('usuarios.excluir', $user->id) }}" onsubmit="return confirm('Are you sure?')" style="display: inline">
        @csrf
        @method('DELETE')
        <button type="submit" title="Delete">Sim</button>
    </form>
</div>

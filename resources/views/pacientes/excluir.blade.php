<div>
    <form method="POST" action="{{ route('pacientes.excluir', $paciente->id) }}" onsubmit="return confirm('Are you sure?')" style="display: inline">
        @csrf
        @method('DELETE')
        <button type="submit" title="Delete">Sim</button>
    </form>
</div>
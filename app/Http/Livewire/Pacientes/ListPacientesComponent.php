<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;
use App\Models\Paciente;
use Livewire\WithPagination;

class ListPacientesComponent extends Component
{

    public $search;


    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {


        $pacientes = Paciente::join('pessoas', 'pacientes.pessoa_id', '=', 'pessoas.id')
            ->select('pacientes.*', 'pessoas.*')
            ->where('pessoas.nome', 'like', "%{$this->search}%")
            ->paginate(10);


        return view('livewire.pacientes.list-pacientes-component', ['pacientes' => $pacientes])->layout('layouts.public');
    }

    public function updating($name, $value)
    {
        if($name == 'search'){
            $this->resetPage();
        }
      
    }
}

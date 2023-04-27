<?php

namespace App\Http\Livewire\Pacientes;

use Livewire\Component;

class CreatePacientesComponent extends Component
{
    
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;
    public $complemento;

    public $nome;
    public $cpf;

    public $data_nacimento;
    public $email;
    public $telefone;

    public function render()
    {
        // = preg_replace('/[^0-9]/', '', $request->cpf);
        // = Carbon::parse($request->data_nacimento)->format('Y-m-d');
        return view('livewire.pacientes.create-pacientes-component')->layout('layouts.public');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PessoaController extends Controller
{

    public function verifyCpf(Request $request)
    {
        $cpf = $request->input('cpf');
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $pessoa = Pessoa::where('cpf', $cpf)->first();
        if ($pessoa) {
            return response()->json(['cpf' => true]);
        } else {
            return response()->json(['cpf' => false]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultaRequest;
use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdateConsultaRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Consulta;
use App\Models\Pessoa;
use App\Models\Endereco;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');
        
        $consultaCount = Consulta::from('consultas')
        ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
        ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
        ->join('users', 'medicos.users_id', '=', 'users.id')
        ->join('pessoas as pacientes_pessoas', 'pacientes.pessoa_id', '=', 'pacientes_pessoas.id')
        ->join('pessoas as medicos_pessoas', 'users.pessoa_id', '=', 'medicos_pessoas.id')
        ->where(function ($query) use ($search) {
            $query->where('pacientes_pessoas.nome', 'like', "%{$search}%")
                ->orWhere('medicos_pessoas.nome', 'like', "%{$search}%");
        })
        ->select('consultas.id')
        ->count();

        $consultas = Consulta::from('consultas')
            ->orderByRaw('DATE(data_consulta) DESC, hora_consulta DESC')
            ->join('pacientes', 'consultas.paciente_id', '=', 'pacientes.id')
            ->join('medicos', 'consultas.medico_id', '=', 'medicos.id')
            ->join('users', 'medicos.users_id', '=', 'users.id')
            ->join('pessoas as pacientes_pessoas', 'pacientes.pessoa_id', '=', 'pacientes_pessoas.id')
            ->join('pessoas as medicos_pessoas', 'users.pessoa_id', '=', 'medicos_pessoas.id')
            ->where(function ($query) use ($search) {
                $query->where('pacientes_pessoas.nome', 'like', "%{$search}%")
                    ->orWhere('medicos_pessoas.nome', 'like', "%{$search}%");
            })
            ->select('consultas.*', 'consultas.id')
            ->paginate(10)->withQueryString();

        $consultas->total($consultaCount);

        foreach ($consultas as $consulta) {
            $consulta->data_consulta_formatted = Carbon::createFromFormat('Y-m-d', $consulta->data_consulta)->format('d/m/Y');

            $horaConsulta = substr($consulta->hora_consulta, 0, 5); // Extrai os primeiros 5 caracteres (hora:minuto)
            $consulta->hora_consulta_formatted = $horaConsulta;
        }

        return view('consultas.list', ['consultas'=> $consultas, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('consultas.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsultaRequest $request)
    {
        DB::transaction(function () use ($request) {

            $consulta = new Consulta();
            $consulta->paciente_id = $request->paciente_id;
            $consulta->medico_id = $request->medico_id;
            $consulta->data_consulta = $request->data_consulta;
            $consulta->hora_consulta = $request->hora_consulta;
            $consulta->save();
        });

        return redirect()->route('consultas.list');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);
        $paciente = $consulta->paciente;
        $medico = $consulta->medico;
        //$paciente = Paciente::with(['pessoa', 'pessoa.endereco'])->findOrFail($id);
        return view('consultas.visualizar', compact('consulta', 'paciente', 'medico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);
        $paciente = $consulta->paciente;
        $medico = $consulta->medico;

        return view('consultas.editar', compact('consulta', 'paciente', 'medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsultaRequest $request, $id)
    {
        DB::beginTransaction();

        $consulta = Consulta::findOrFail($id);
        $consulta->paciente_id = $request->paciente_id;
        $consulta->medico_id = $request->medico_id;
        $consulta->data_consulta = $request->data_consulta;
        $consulta->hora_consulta = $request->hora_consulta;
        $consulta->save();

        DB::commit();
        
        return redirect()->route('consultas.list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consultas.list')->with('success', 'Consulta deletada com sucesso!');
    }

}

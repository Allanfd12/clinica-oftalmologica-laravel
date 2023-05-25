<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'users_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'pessoa_id');
    }

}

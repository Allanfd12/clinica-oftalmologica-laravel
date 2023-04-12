<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    use HasFactory;

    protected $table = 'prontuarios';

    protected $fillable = [
        'descricao',
        'qp',
        'biomicoscopia',
        'conduta',
        'grau',
        'paciente_id',
    ];
}

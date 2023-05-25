<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    use HasFactory;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
    
    protected $table = 'prontuarios';
    protected $fillable = [
        'descricao',
        'qp',
        'biomicoscopia',
        'conduta',
        'grau'
    ];
}

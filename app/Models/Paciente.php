<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory;

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}




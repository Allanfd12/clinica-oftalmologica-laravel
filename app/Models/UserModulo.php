<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModulo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_modulos';

    protected $fillable = [
        'user_id',
        'modulo_id',
    ];
}

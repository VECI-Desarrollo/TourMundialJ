<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'comentario_finanzas',
        'comentario_general',

    ];
}

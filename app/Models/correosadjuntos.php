<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class correosadjuntos extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'estado',
        'pais_id',

    ];
}

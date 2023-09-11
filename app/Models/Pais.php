<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'iata',
        'moneda',
        'moneda_iso',
        'bandera',
    ];

    protected $table = "paises";
}

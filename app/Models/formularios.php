<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formularios extends Model
{
    use HasFactory;


    protected $fillable = [
        'formulario',
        'estado',
        'webpay',
    ];
}

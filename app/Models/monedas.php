<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monedas extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'moneda',
        'pais_id',
    ];

}

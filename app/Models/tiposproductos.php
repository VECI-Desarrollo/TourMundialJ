<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposproductos extends Model
{
    use HasFactory;




    protected $fillable = [
        'id',
        'tipoProducto',
        'pais_id',

    ];



}

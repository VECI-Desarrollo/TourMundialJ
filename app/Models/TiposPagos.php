<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipospagos extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'tipoPago',

    ];


}

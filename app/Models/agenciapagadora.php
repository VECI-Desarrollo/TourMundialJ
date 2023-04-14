<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenciapagadora extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'nombre',
    ];
    protected $table = 'agenciapagadora';
}

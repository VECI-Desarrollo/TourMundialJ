<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class registrospagosagencias extends Model
{
    use HasFactory;



    protected $fillable=[
    'id',
    'vendedor',
    'agenciaNombre',
    'agenciaContacto',
    'expediente',
    'tiposPagos_id',
    'monto',
    'comprobante',
    'tiposProductos_id',
    'moneda',
    'tipoCambio',
    'fechaDeposito'

    ];







}

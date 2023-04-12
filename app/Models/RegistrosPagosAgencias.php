<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class registrospagosagencias extends Model
{
    use HasFactory;

   
  
    protected $fillable=[
    'id',
    'Usuarios_id',
    'agenciaNombre',
    'agenciaContacto',
    'expediente',
    'tiposPagos_id',
    'monto',
    'fecha',
    'comprobante',
    'tiposProductos_id',
    'moneda',
    'tipoCambio',
    'fechaDeposito'

    ];





  

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;



class registrospagosagencias extends Model
{
    use HasFactory;

    use HasUuids; // importa el trait HasUuid

    protected $keyType = 'string'; // define el tipo de dato del campo "id"
    public $incrementing = false; // desactiva la auto-incrementación del campo "id"

    protected $fillable=[
    'id',
    'vendedor',
    'id_vendedor',
    'agenteViajes',
    'agenciaNombre',
    'agenciaContacto',
    'expediente',
    'tiposPagos_id',
    'monto',
    'comprobante',
    'tiposProductos_id',
    'moneda',
    'banco',
    'tipoCambio',
    'fechaDeposito',
    'estado',
    'comentario_finanzas',
    'comentario_general',


    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }



}

<?php

namespace Database\Seeders;

use App\Models\registrospagosagencias;
use App\Models\tipospagos;
use App\Models\tiposproductos;
use App\Models\vendedores;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();
        for($i=1; $i <= 5; $i++)
        {
   // Obtener un registro aleatorio de la tabla "tipoPagos"
    $tiposPagos_id = tipospagos::inRandomOrder()->first();
    // Obtener un registro aleatorio de la tabla "tiposProductos"
    $tiposProductos = tiposproductos::inRandomOrder()->first();
     // Obtener un registro aleatorio de la tabla "vendedores"
     $vendedores = vendedores::inRandomOrder()->first();

            registrospagosagencias::create
            (
                [
                  
                  'vendedor'=>   $vendedores->nombre.$vendedores->apellido ,
                  'id_vendedor'=>  $vendedores->id ,
                  'agenteViajes' => $faker->name,
            'agenciaNombre' => $faker->company ,
            'expediente' => mt_rand(1,150),
            'tiposPagos_id' => $tiposPagos_id->tipoPago,
            'monto' =>  $faker->randomFloat(0, 100, 1000),
            'comprobante' => $faker->address,
            'tiposProductos_id'=> $tiposProductos->tipoProducto,
            'moneda'=> $tiposPagos_id->moneda,
            'banco' => null,
            'fechaDeposito' => date('Y-m-d'),
            'estado'=> "en curso",
            'created_at'=> '2023-08-14',

                ]
            );
        }
    }
}

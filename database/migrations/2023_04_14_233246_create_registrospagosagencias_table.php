<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrospagosagencias', function (Blueprint $table) {
            $table->id();
        $table->text('vendedor');
        $table->string('agenciaNombre');
        $table->string('expediente');
        $table->unsignedBigInteger('tiposPagos_id');
        $table->decimal('monto');
        $table->string('comprobante');
        $table->text('tiposProductos_id');
        $table->string('moneda');
        $table->date('fechaDeposito');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrospagosagencias');
    }
};

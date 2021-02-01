<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendiente_id')
                ->constrained('pendientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('contrato_id')
                ->constrained('contratos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('fechaCobro');
            $table->integer('cuota');
            $table->float('monto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobros');
    }
}

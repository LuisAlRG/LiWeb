<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Venta', function (Blueprint $table) {
            $table->id('idVenta');
            $table->foreignId('idEmpleado')
			 ->references('idEmpleado')
                ->on('Empleado')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('cliente')->nullable();
            $table->timestamp('fechaHora');
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
        Schema::dropIfExists('Venta');
    }
}

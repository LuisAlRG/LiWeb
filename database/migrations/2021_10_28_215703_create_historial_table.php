<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idEmpleado')
			 ->references('idEmpleado')
                ->on('Empleado')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('operacion');
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
        Schema::dropIfExists('Historial');
    }
}

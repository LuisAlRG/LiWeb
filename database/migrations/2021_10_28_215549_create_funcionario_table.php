<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Funcionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idEmpleado')
			 ->references('idEmpleado')
                ->on('Empleado')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('contratado');
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
        Schema::dropIfExists('Funcionario');
    }
}

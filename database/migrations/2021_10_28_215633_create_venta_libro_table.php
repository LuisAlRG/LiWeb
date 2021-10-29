<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('VentaLibro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idVenta')
			 ->references('idVenta')
                ->on('Venta')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('idLibro')
			 ->references('idLibro')
                ->on('Libro')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('cantidad');
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
        Schema::dropIfExists('VentaLibro');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Libro', function (Blueprint $table) {
            $table->id('idLibro');
            $table->foreignId('idEditorial')
			 ->references('idEditorial')
                ->on('Editorial')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('titulo');
            $table->decimal('precio',15,2);
            $table->integer('edicion');
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
        Schema::dropIfExists('Libro');
    }
}

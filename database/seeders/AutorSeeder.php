<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Autor;
use Illuminate\Support\Facades\Schema;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();

        Schema::enableForeignKeyConstraints();
        $faker = Faker::create();
        for($i=0; $i<10; $i++){
        	$nombre = $faker->realText(10);
        	$apellido = $faker->realText(10);
        	$autor = new Autor();
        	$autor->nombre = $nombre;
        	$autor->apellido = $apellido;
        	$autor->save();
        }
    }
}

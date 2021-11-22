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

        /*
        $faker = Faker::create();
        for($i=0; $i<10; $i++){
        	$nombre = $faker->realText(10);
        	$apellido = $faker->realText(10);
        	$autor = new Autor();
        	$autor->nombre = $nombre;
        	$autor->apellido = $apellido;
        	$autor->save();
        }
        */
        $autor = new Autor();
        $autor->nombre = "Roger S.";    
        $autor->apellido = "Pressman";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Ian";
        $autor->apellido = "Sommerville";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "John"; 
        $autor->apellido = "Bedini";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Grady";
        $autor->apellido = "Booch";
        $autor->save();
        $autor = new Autor();//
        $autor->nombre = "Brend";
        $autor->apellido = "Bruegge";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Whatts";
        $autor->apellido = "Humphrey";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Ivar";
        $autor->apellido = "Jacobson";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "James";
        $autor->apellido = "Rumbaugh";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Kenneth E.";
        $autor->apellido = "Kendall";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Julie E.";
        $autor->apellido = "Kendall";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Henrik";
        $autor->apellido = "Kniberg";
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "Carlos";
        $autor->apellido = "Fontela";  
        $autor->save();
        $autor = new Autor();      
        $autor->nombre = "Alfredo";
        $autor->apellido = "Weitzenfeld";  
        $autor->save();
        $autor = new Autor();
        $autor->nombre = "James";
        $autor->apellido = "Senn";      
        $autor->save();
        $autor = new Autor();  
        $autor->nombre = "Mario G.";
        $autor->apellido = "Piattini Velthuis";
        $autor->save();
    }
}

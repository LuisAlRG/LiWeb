<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneroZeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genero = new Genero();
        $genero->nombre = "Aventura";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Ciencia Ficcion";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Fantasia";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Gotica";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Policiaca";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Romance";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Paranormal";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Terror";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Humor";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Poesia";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Mitologia";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Documental";
        $genero->save();
        $genero = new Genero();
        $genero->nombre = "Educativo";
        $genero->save();
    }
}

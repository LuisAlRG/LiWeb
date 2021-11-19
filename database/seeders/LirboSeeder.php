<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('Editorial')->truncate();
		Schema::enableForeignKeyConstraints();
        $libro = new Libro();
        $libro->titulo = "Calculo Multiples variables";
        $libro->precio = 5000;
        $libro->edicion = 7;
        $libro->cantidad = 25;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        // agregar otro
        $libro = new Libro();
        $libro->titulo = "Sistemas embedidos";
        $libro->precio = 1750;
        $libro->edicion = 4;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Calculo infinitesimal";
        $libro->precio = 4000;
        $libro->edicion = 6;
        $libro->cantidad = 43;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Deutsch Na Klar";
        $libro->precio = 2750;
        $libro->edicion = 7;
        $libro->cantidad = 18;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Ecuaciones diferenciales";
        $libro->precio = 2350;
        $libro->edicion = 2;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Programacion Arduino";
        $libro->precio = 5750;
        $libro->edicion = 9;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Programación Raspberry Pi";
        $libro->precio = 1730;
        $libro->edicion = 7;
        $libro->cantidad = 35;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Vision Computacional";
        $libro->precio = 5431;
        $libro->edicion = 2;
        $libro->cantidad = 17;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Redes Bayesianas";
        $libro->precio = 5412;
        $libro->edicion = 6;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Teoría de Grafos";
        $libro->precio = 3781;
        $libro->edicion = 2;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "English for Everyone, Phrasal Verbs";
        $libro->precio = 2134;
        $libro->edicion = 3;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Inteligencia Artificial";
        $libro->precio = 6000;
        $libro->edicion = 1;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Ecuaciones de Maxwell";
        $libro->precio = 5000;
        $libro->edicion = 4;
        $libro->cantidad = 45;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Electromagnetismo";
        $libro->precio = 3215;
        $libro->edicion = 2;
        $libro->cantidad = 23;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "English Idioms in Use";
        $libro->precio = 2500;
        $libro->edicion = 11;
        $libro->cantidad = 32;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "IELTS Academic 14";
        $libro->precio = 1250;
        $libro->edicion = 7;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Filme y Cinemática";
        $libro->precio = 2341;
        $libro->edicion = 2;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Arquitectura";
        $libro->precio = 2350;
        $libro->edicion = 2;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Artes graficas";
        $libro->precio = 2341;
        $libro->edicion = 4;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Fotografía";
        $libro->precio = 2730;
        $libro->edicion = 5;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Arte Contemporanea";
        $libro->precio = 4312;
        $libro->edicion = 1;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Química orgánica";
        $libro->precio = 3215;
        $libro->edicion = 3;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Algoritmos y Estructura de datos";
        $libro->precio = 5000;
        $libro->edicion = 12;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Psicología";
        $libro->precio = 5730;
        $libro->edicion = 1;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Antropología";
        $libro->precio = 799;
        $libro->edicion = 5;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Mecánica";
        $libro->precio = 3129;
        $libro->edicion = 7;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Bioingeniería";
        $libro->precio = 2544;
        $libro->edicion = 8;
        $libro->cantidad = 43;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Telecomunicaciones";
        $libro->precio = 2999;
        $libro->edicion = 3;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Criptografía";
        $libro->precio = 999;
        $libro->edicion = 10;
        $libro->cantidad = 7;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Base de datos";
        $libro->precio = 2999;
        $libro->edicion = 7;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Desarrollo web";
        $libro->precio = 5432;
        $libro->edicion = 1;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Programación en Haskell";
        $libro->precio = 1199;
        $libro->edicion = 4;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Wolfram Mathematica, Manual";
        $libro->precio = 4999;
        $libro->edicion = 8;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Cibernética";
        $libro->precio = 2131;
        $libro->edicion = 10;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Zoología";
        $libro->precio = 2100;
        $libro->edicion = 3;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Pre-Calculo";
        $libro->precio = 3999;
        $libro->edicion = 9;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Álgebra Lineal";
        $libro->precio = 1999;
        $libro->edicion = 5;
        $libro->cantidad = 14;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Ánalisis Complejo";
        $libro->precio = 5999;
        $libro->edicion = 10;
        $libro->cantidad = 9;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Ecuaciones Diferenciables Parciales";
        $libro->precio = 1299;
        $libro->edicion = 3;
        $libro->cantidad = 7;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Teoría de los números";
        $libro->precio = 4999;
        $libro->edicion = 10;
        $libro->cantidad = 8;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();

        $libro = new Libro();
        $libro->titulo = "Topología";
        $libro->precio = 1250;
        $libro->edicion = 7;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
    }
}

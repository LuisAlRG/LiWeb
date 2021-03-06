<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Libro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Historial;
use Illuminate\Support\Facades\Schema;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Schema::disableForeignKeyConstraints();
        //DB::table('Editorial')->truncate();
		//Schema::enableForeignKeyConstraints();
        $libro = new Libro();//1
        $libro->titulo = "Calculo Multiples variables";
        $libro->precio = 5000;
        $libro->edicion = 7;
        $libro->cantidad = 25;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $genero = Genero::find(13);
        $libro->generos()->save($genero);
        $autor = Autor::find(1);
        $libro->autores()->save($autor);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();
        
        // agregar otro
        $libro = new Libro();//2
        $libro->titulo = "Sistemas embedidos";
        $libro->precio = 1750;
        $libro->edicion = 4;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $genero = Genero::find(2);
        $libro->generos()->save($genero);
        $genero = Genero::find(13);
        $libro->generos()->save($genero);
        $autor = Autor::find(5);
        $libro->autores()->save($autor);
        $autor = Autor::find(6);
        $libro->autores()->save($autor);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//3
        $libro->titulo = "Calculo infinitesimal";
        $libro->precio = 4000;
        $libro->edicion = 6;
        $libro->cantidad = 43;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $genero = Genero::find(13);
        $libro->generos()->save($genero);
        $autor = Autor::find(6);
        $libro->autores()->save($autor);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//4
        $libro->titulo = "Deutsch Na Klar";
        $libro->precio = 2750;
        $libro->edicion = 7;
        $libro->cantidad = 18;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $genero = Genero::find(6);
        $libro->generos()->save($genero);
        $autor = Autor::find(9);
        $libro->autores()->save($autor);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//5
        $libro->titulo = "Ecuaciones diferenciales";
        $libro->precio = 2350;
        $libro->edicion = 2;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $genero = Genero::find(13);
        $libro->generos()->save($genero);
        $autor = Autor::find(1);
        $libro->autores()->save($autor);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//6
        $libro->titulo = "Programacion Arduino";
        $libro->precio = 5750;
        $libro->edicion = 9;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this-> AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//7
        $libro->titulo = "Programaci??n Raspberry Pi";
        $libro->precio = 1730;
        $libro->edicion = 7;
        $libro->cantidad = 35;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//8
        $libro->titulo = "Vision Computacional";
        $libro->precio = 5431;
        $libro->edicion = 2;
        $libro->cantidad = 17;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//9
        $libro->titulo = "Redes Bayesianas";
        $libro->precio = 5412;
        $libro->edicion = 6;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//10
        $libro->titulo = "Teor??a de Grafos";
        $libro->precio = 3781;
        $libro->edicion = 2;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//11
        $libro->titulo = "English for Everyone, Phrasal Verbs";
        $libro->precio = 2134;
        $libro->edicion = 3;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//12
        $libro->titulo = "Inteligencia Artificial";
        $libro->precio = 6000;
        $libro->edicion = 1;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//13
        $libro->titulo = "Ecuaciones de Maxwell";
        $libro->precio = 5000;
        $libro->edicion = 4;
        $libro->cantidad = 45;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//14
        $libro->titulo = "Electromagnetismo";
        $libro->precio = 3215;
        $libro->edicion = 2;
        $libro->cantidad = 23;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//15
        $libro->titulo = "English Idioms in Use";
        $libro->precio = 2500;
        $libro->edicion = 11;
        $libro->cantidad = 32;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = 2;
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//16
        $libro->titulo = "IELTS Academic 14";
        $libro->precio = 1250;
        $libro->edicion = 7;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//17
        $libro->titulo = "Filme y Cinem??tica";
        $libro->precio = 2341;
        $libro->edicion = 2;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//18
        $libro->titulo = "Arquitectura";
        $libro->precio = 2350;
        $libro->edicion = 2;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//19
        $libro->titulo = "Artes graficas";
        $libro->precio = 2341;
        $libro->edicion = 4;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//20
        $libro->titulo = "Fotograf??a";
        $libro->precio = 2730;
        $libro->edicion = 5;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//21
        $libro->titulo = "Arte Contemporanea";
        $libro->precio = 4312;
        $libro->edicion = 1;
        $libro->cantidad = 5;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//22
        $libro->titulo = "Qu??mica org??nica";
        $libro->precio = 3215;
        $libro->edicion = 3;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//23
        $libro->titulo = "Algoritmos y Estructura de datos";
        $libro->precio = 5000;
        $libro->edicion = 12;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//24
        $libro->titulo = "Psicolog??a";
        $libro->precio = 5730;
        $libro->edicion = 1;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//25
        $libro->titulo = "Antropolog??a";
        $libro->precio = 799;
        $libro->edicion = 5;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//26
        $libro->titulo = "Mec??nica";
        $libro->precio = 3129;
        $libro->edicion = 7;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//27
        $libro->titulo = "Bioingenier??a";
        $libro->precio = 2544;
        $libro->edicion = 8;
        $libro->cantidad = 43;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//28
        $libro->titulo = "Telecomunicaciones";
        $libro->precio = 2999;
        $libro->edicion = 3;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//29
        $libro->titulo = "Criptograf??a";
        $libro->precio = 999;
        $libro->edicion = 10;
        $libro->cantidad = 7;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//30
        $libro->titulo = "Base de datos";
        $libro->precio = 2999;
        $libro->edicion = 7;
        $libro->cantidad = 12;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//31
        $libro->titulo = "Desarrollo web";
        $libro->precio = 5432;
        $libro->edicion = 1;
        $libro->cantidad = 10;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//32
        $libro->titulo = "Programaci??n en Haskell";
        $libro->precio = 1199;
        $libro->edicion = 4;
        $libro->cantidad = 19;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//33
        $libro->titulo = "Wolfram Mathematica, Manual";
        $libro->precio = 4999;
        $libro->edicion = 8;
        $libro->cantidad = 21;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//34
        $libro->titulo = "Cibern??tica";
        $libro->precio = 2131;
        $libro->edicion = 10;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//35
        $libro->titulo = "Zoolog??a";
        $libro->precio = 2100;
        $libro->edicion = 3;
        $libro->cantidad = 15;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//36
        $libro->titulo = "Pre-Calculo";
        $libro->precio = 3999;
        $libro->edicion = 9;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//37
        $libro->titulo = "??lgebra Lineal";
        $libro->precio = 1999;
        $libro->edicion = 5;
        $libro->cantidad = 14;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//38
        $libro->titulo = "??nalisis Complejo";
        $libro->precio = 5999;
        $libro->edicion = 10;
        $libro->cantidad = 9;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//39
        $libro->titulo = "Ecuaciones Diferenciables Parciales";
        $libro->precio = 1299;
        $libro->edicion = 3;
        $libro->cantidad = 7;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//40
        $libro->titulo = "Teor??a de los n??meros";
        $libro->precio = 4999;
        $libro->edicion = 10;
        $libro->cantidad = 8;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();

        $libro = new Libro();//41
        $libro->titulo = "Topolog??a";
        $libro->precio = 1250;
        $libro->edicion = 7;
        $libro->cantidad = 20;
        $libro->idEditorial = random_int(1, 11);
        $libro->save();
        $this->AderirGenerosYAutoresAleatorios($libro);

        $historial = new Historial();
		$historial->idEmpleado = random_int(3, 5);
		$historial->operacion = "Agrego libro: ".$libro->titulo;
        $historial->fechaHora = $this->GenerarFecha();
		$historial->save();
    }

    function AderirGenerosYAutoresAleatorios($libro){
        $genero = Genero::find(13);
        $libro->generos()->save($genero);
        $masGeneros = random_int(0, 2);
        for($i=0;$i<$masGeneros;$i++){
            $genero = Genero::find(random_int(1, 12));
            $libro->SaveGenero($genero);
        }
        $autor = Autor::find(3);
        $libro->SaveAutor($autor);
        $masAutores = random_int(0, 2);
        for($i=0;$i<$masAutores;$i++){
            $autor = Autor::find(random_int(1, 15));
            $libro->SaveAutor($autor);
        }
    }

    function GenerarFecha(){
        $dia = random_int(1,28);
        $mes = random_int(1,11);
        $anio = random_int(2018,2021);
        return $anio.'-'.$mes.'-'.$dia.' 00:00:00';
    }
}

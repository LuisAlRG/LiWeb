<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\Libro;
use App\Models\Empleado;
use App\Models\VentaLibro;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $venta =  new Venta();
        //$empleado = Empleado::find(1);
        $venta->idEmpleado=2;
        $venta->cliente="Matias Colombio";
        $venta->save();
        //calculo multiples variables
        $venta->SaveLibroCant(1,1);
        //Calculo infinitesimal
        $venta->SaveLibroCant(2,1);
        //Ecuaciones diferenciales
        $venta->SaveLibroCant(3,1);

        $venta = new Venta();
        $venta->idEmpleado=3;
        $venta->cliente="Karla";
        $venta->save();
        //Inteligencia Artificial
        $venta->SaveLibroCant(12,10);

        $venta = new Venta();
        $venta->idEmpleado=4;
        $venta->cliente="Nacho";
        $venta->save();
        //Electromagnetismo
        $venta->SaveLibroCant(14,1);
        //Química orgánica
        $venta->SaveLibroCant(22,1);
        //Mecánica
        $venta->SaveLibroCant(26,1);

        $venta = new Venta();
        $venta->idEmpleado=6;
        $venta->cliente="Lic. Tadeo";
        $venta->save();
        //Base de datos
        $venta->SaveLibroCant(30,10);
        //Desarrollo web"
        $venta->SaveLibroCant(31,5);

 
        $venta = new Venta();
        $venta->idEmpleado=7;
        $venta->save();
        //Zoología
        $venta->SaveLibroCant(35,1);
        //Criptografía
        $venta->SaveLibroCant(29,4);
        //Antropología
        $venta->SaveLibroCant(25,2);
        //Arte Contemporanea
        $venta->SaveLibroCant(21,8);
        //Artes graficas
        $venta->SaveLibroCant(19,3);
        //Filme y Cinemática
        $venta->SaveLibroCant(17,1);

        //generar 10 mas aleatorio
        for($i=0; $i<10; $i++){
            $venta = new Venta();
            $venta->idEmpleado=random_int(1, 7);
            //sera conosido
            if(random_int(1, 2) == 2){
                $nombreAleatorio = '';
                switch(random_int(1, 4)){
                    case 4:
                        $nombreAleatorio = "Luisito";
                        break;
                    case 3:
                        $nombreAleatorio = "Amador";
                        break;
                    case 2:
                        $nombreAleatorio = "Lupita";
                        break;
                    case 1:
                        $nombreAleatorio = "Santeago";
                        break;
                    case 0:
                        $nombreAleatorio = "Nacho";
                        break;
                }
                $venta->cliente=$nombreAleatorio;
            }
            $venta->save();
            //requiere un libro vendido
            $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
            //genera mas libro para relacionar
            switch(random_int(0,5)){
                case 5:
                    $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
                case 4:
                    $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
                case 3:
                    $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
                case 2:
                    $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
                case 1:
                    $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
                case 0:
                    break;
            }
        }

    }

    
}

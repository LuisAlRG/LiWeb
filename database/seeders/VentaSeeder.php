<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\Libro;
use App\Models\Empleado;
use App\Models\Historial;
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
        $venta->fechaHora= $this->GenerarFecha();
        $venta->save();
        //calculo multiples variables
        $venta->SaveLibroCant(1,1);
        //Calculo infinitesimal
        $venta->SaveLibroCant(2,1);
        //Ecuaciones diferenciales
        $venta->SaveLibroCant(3,1);

        $historial = new Historial();
        $historial->idEmpleado = $venta->idEmpleado;
        $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
        $historial->fechaHora = $venta->fechaHora;
        $historial->save();

        $venta = new Venta();
        $venta->idEmpleado=3;
        $venta->cliente="Karla";
        $venta->fechaHora= $this->GenerarFecha();
        $venta->save();
        //Inteligencia Artificial
        $venta->SaveLibroCant(12,10);

        $historial = new Historial();
        $historial->idEmpleado = $venta->idEmpleado;
        $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
        $historial->fechaHora = $venta->fechaHora;
        $historial->save();

        $venta = new Venta();
        $venta->idEmpleado=4;
        $venta->cliente="Nacho";
        $venta->fechaHora= $this->GenerarFecha();
        $venta->save();
        //Electromagnetismo
        $venta->SaveLibroCant(14,1);
        //Química orgánica
        $venta->SaveLibroCant(22,1);
        //Mecánica
        $venta->SaveLibroCant(26,1);

        $historial = new Historial();
        $historial->idEmpleado = $venta->idEmpleado;
        $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
        $historial->fechaHora = $venta->fechaHora;
        $historial->save();

        $venta = new Venta();
        $venta->idEmpleado=6;
        $venta->cliente="Lic. Tadeo";
        $venta->fechaHora= $this->GenerarFecha();
        $venta->save();
        //Base de datos
        $venta->SaveLibroCant(30,10);
        //Desarrollo web"
        $venta->SaveLibroCant(31,5);

        $historial = new Historial();
        $historial->idEmpleado = $venta->idEmpleado;
        $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
        $historial->fechaHora = $venta->fechaHora;
        $historial->save();
 
        $venta = new Venta();
        $venta->idEmpleado=7;
        $venta->fechaHora= $this->GenerarFecha();
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

        $historial = new Historial();
        $historial->idEmpleado = $venta->idEmpleado;
        $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
        $historial->fechaHora = $venta->fechaHora;
        $historial->save();

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
            $venta->fechaHora= $this->GenerarFecha();
            $venta->save();
            //requiere un libro vendido
            $venta->SaveLibroCant(random_int(1, 41),random_int(1, 5));
            //genera mas libro para relacionar
            $maslibros = random_int(0,5);
            while($maslibros > 0){
                $idLibro = random_int(1,41);
                $cantidadGenerado = random_int(1,5);
                $venta->SaveLibroCant($idLibro, $cantidadGenerado);
                $maslibros--;
            }
            $historial = new Historial();
            $historial->idEmpleado = $venta->idEmpleado;
            $historial->operacion = "Realizo una venta, clave:".$venta->idVenta;
            $historial->fechaHora = $venta->fechaHora;
            $historial->save();
        }

    }

    function GenerarFecha(){
        $dia = random_int(1,28);
        $mes = random_int(1,11);
        $anio = random_int(2018,2021);
        return $anio.'-'.$mes.'-'.$dia.' 00:00:00';
    }
}

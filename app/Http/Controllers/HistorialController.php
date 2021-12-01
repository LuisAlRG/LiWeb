<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Historial;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    //
    function ViewHistorial(){
        return view('pantallaHistorial',['mensajeServidor'=>null]);
    }

    function VerHitorial(){
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();
        $caso = $empleado->QueEs();
        $historial = [];
        if($caso < 2){
            $historial = $empleado->historial()->orderBy('fechaHora', 'asc')->get();
        }
        else{
            $historial = Historial::orderBy('fechaHora', 'asc')->get();
        }
        $historial = $this->PrepararHistorial($historial);
        return $historial;
    }

    function ConsultarHistorial(Request $req){
        $operacion = $req->input('operacion');
        $fechaMin = $req->input('fechaMin');
        $fechaMax = $req->input('fechaMax');
        $operacion = (int)$operacion;
        $nombreOperacion = '';
        switch($operacion){
            case 1: $nombreOperacion='venta'; break;
            case 2: $nombreOperacion='libro'; break;
            case 3: $nombreOperacion='empleado'; break;
        }
        $historial = Historial::where('operacion','LIKE','%'.$nombreOperacion.'%');

        //revisar si el usuario es funcionario
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();
        $caso = $empleado->QueEs();
        if($caso == 1){
            $historial = $historial->where('idEmpleado','=',$empleado->idEmpleado);
        }

        if($fechaMin){
            $historial = $historial->where('fechaHora','>=',$fechaMin);
        }
        if($fechaMax){
            $historial = $historial->where('fechaHora','<=',$fechaMax);
        }
        $historial = $historial->get();
        $historial = $this->PrepararHistorial($historial);
        return $historial;
    }

    public function PrepararHistorial($listaHistorial){
        foreach($listaHistorial as $key => $historial){
            $empleado = $historial->empleado()->first();
            $caso = $empleado->QueEs();
            $filtro = '';
            if(stripos($historial->operacion,'libro')){
                $filtro = 'Libros';
            }
            else if(stripos($historial->operacion,'una venta')){
                $filtro = 'Ventas';
            }
            else if(stripos($historial->operacion,'Empleado')){
                $filtro = 'Empleados';
            }
            else{
                $filtro = 'Otros';
            }
            $historial->idEmpleado = $empleado->idEmpleado;
            $historial->nombreEmp = $empleado->nombre;
            $historial->puestoEmp = $caso;
            $historial->filtro = $filtro;
        }
        return $listaHistorial;
    }
}

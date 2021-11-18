<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Modelo Ventas
     * idVenta      :intlog
     * idEmpleado   :intlog
     * cliente      :string
     * fechaHora    :date;
     */
    //
    function ViewVentas(){
        return view('pantallaVenta');
    }
    function VerTodosVentas(){
        return Libro::all();
    }
    function ConsultarVentas(Request $req){
        $clave = $req->input('clave');
        $fecha = $req->input('fecha');
        $categoria = $req->input('categoria');
        $cliente = $req->input('cliente');
        $idEmpleado = $req->input('responsable');
        
    }
}

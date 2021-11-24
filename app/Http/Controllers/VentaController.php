<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;

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
    function ViewVender(){
        $empleado = Auth::user();
        //echo $empleado;
        $empleado = $empleado->empleado()->get()[0];
        //echo $empleado;
        return view('pantallaAccionVenta',['responsable' => $empleado->nombre]);
    }

    function ViewVenderYa(Request $req){
        $cliente = $req->input('cliente');
        $listLibrosId = $req->input('librosSelct');
        $listLibrosCant = $req->input('librosCantidad');
        //echo $cliente;
        //echo $listLibrosId;
        //echo $listLibrosCant;

        $empleado = Auth::user();
        //echo $empleado;
        $empleado = $empleado->empleado()->get()[0];
        //echo $empleado;
        return view('pantallaAccionVentaElemento',[
            'responsable' => $empleado->nombre,
            'cliente' => $cliente,
            'librosSelct' => $listLibrosId,
            'librosCantidad' => $listLibrosCant
        ]);
    }

    function VerTodosVentas(){
        $ventas = Venta::all();
        if($ventas){
            foreach($ventas as $key => $venta){
                $venta->vendidos = $venta->PrecioTotal();
                $venta->responsable = $venta->getResponsable();
            }
        }
        return $ventas;
    }

    function VerTodosLibros(){
        $libros = Libro::all();
        if($libros){
            foreach($libros as $key => $libro){
                $libro->autores = $libro->autores()->get();
                $libro->editorial = $libro->editorial()->get()[0]->nombre;
            }
        }
        return $libros ;
    }

    function ConsultarVentas(Request $req){
        $clave = $req->input('clave');
        $fecha = $req->input('fecha');
        $categoria = $req->input('categoria');
        $cliente = $req->input('cliente');
        $idEmpleado = $req->input('responsable');
        
    }

    function ConsultarLirbos(Request $req){
        $clave = $req->input('clave');
        $titulo = $req->input('tituloLibro');
        $precio = $req->input('precio');
        $filtro = $req->input('categoria');

        

        if(is_numeric($clave)){
            $elemento = Libro::find($clave);
            return $elemento;
        }
    }

    // /Vender/LibrosSeleccionados
    function DesplegarLibrosSeleccionado(Request $req){
        $listLibrosId =     $req->input('librosSelct');
        $listLibrosCant =   $req->input('librosCantidad');

        $listLibrosId =     explode(' ',$listLibrosId);
        $listLibrosCant =   explode(' ',$listLibrosCant);

        $libros = array();
        foreach ($listLibrosId as $key => $LibroId) {
            if( !is_numeric($LibroId) ){
                return 1;
            }
            $elLibros = Libro::find($LibroId);
            $elLibros->cantidasSel = (int) $listLibrosCant[$key];
            $libros[] = $elLibros;
        }
        
        
        if($libros){
            foreach($libros as $key => $libro){
                $libro->autores = $libro->autores()->get();
                $libro->editorial = $libro->editorial()->get()[0]->nombre;
            }
        }
        return $libros;
    }

    function InsertarVenta(Request $req){
        $cliente = $req->input('cliente');
        $listLibrosId = $req->input('librosSelct');
        $listLibrosCant = $req->input('librosCantidad');
        $empleado = Auth::user();
        $empleado = $empleado->empleado()->get()[0];

        $nuevaVenta = new Venta();
        $nuevaVenta->idEmpleado = $empleado->idEmpleado;
        $nuevaVenta->cliente = $cliente;
    }
}

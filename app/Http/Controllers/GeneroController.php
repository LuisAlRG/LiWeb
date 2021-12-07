<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use Illuminate\Support\Facades\Auth;

class GeneroController extends Controller
{
    /**
     * Genero
     * idGenero
     * nombre
     */
    //funciones de vista
    function ViewGenero(Request $req){
        $ruta = $req->input('nivelEmpleado','');
        return view($ruta.'pantallaGenero',['mensajeServidor'=>null]);
    }

    function VerTodoGeneros(){
        $generos = Genero::all();
        return $generos;
    }

    function ConsultarGenero(Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        if(is_numeric($clave)){
            $clave = (int) $clave;
            $elemento = Genero::find($clave);
            return [0=>$elemento];
        }
        $elementos = Genero::where('nombre','LIKE','%'.$nombre.'%')
            ->get();
        return $elementos;
    }
    function InsertarGenero (Request $req){
        $nombre = $req->input('nombre');
        $elemento = Genero::where('nombre','=',$nombre)
            ->get();
        if(count($elemento)){
            return 're';
        }
        $genero = new Genero();
        $genero->nombre = $nombre;
        $genero->save();
        return $genero;
    }
    function ModificarGenero (Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        $clave = (int) $clave;

        $elementos = Genero::where('nombre','=',$nombre)
            ->get();
        if(count($elementos)){
            foreach($elementos as $key => $elemento){
                if($elemento->idGenero != $clave)
                    return 're';
            }
        }
        $genero = Genero::find($clave );
        $genero->nombre = $nombre;
        $genero->save();
        return $genero;
    }
    function BorrarGenero (Request $req){
        $clave = $req->input('clave');
        $clave = (int) $clave;
        $genero = Genero::find($clave);
        if($genero->TieneLibro()){
            return 'no';
        }
        $genero->delete();
        return $genero;
    }
}

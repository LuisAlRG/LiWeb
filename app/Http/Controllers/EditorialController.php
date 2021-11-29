<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;
use Illuminate\Support\Facades\Auth;

class EditorialController extends Controller
{
    /**
     * Editorial
     * idEditorial
     * nombre
     */
    //funciones de vistas
    function ViewEditorial(){
        $ruta = '';
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();

        $puesto = $empleado->QueEs();
        if($puesto == 1){
            $ruta = 'funcionario.';
        }
        return view($ruta.'pantallaEditorial',['mensajeServidor'=>null]);
    }

    function VerTodosEditoriales(){
        $editoriales = Editorial::all();
        return $editoriales;
    }

    function ConsultarEditorial(Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        if(is_numeric($clave)){
            $clave = (int) $clave;
            $elemento = Editorial::find($clave);
            return [0=>$elemento];
        }
        $elementos = Editorial::where('nombre','LIKE','%'.$nombre.'%')
            ->get();
        return $elementos;
    }

    function InsertarEditorial(Request $req){
        $nombre = $req->input('nombre');
        $elemento = Editorial::where('nombre','=',$nombre)
            ->get();
        if(count($elemento)){
            return 're';
        }
        $editorial = new Editorial();
        $editorial->nombre = $nombre;
        $editorial->save();
        return $editorial;
    }

    function ModificarEditorial(Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        $clave = (int) $clave;

        $elementos = Editorial::where('nombre','=',$nombre)
            ->get();
        if(count($elementos)){
            foreach($elementos as $key => $elemento){
                if($elemento->idEditorial != $clave)
                    return 're';
            }            
        }
        $editorial = Editorial::find($clave);
        $editorial->nombre = $nombre;
        $editorial->save();
        return $editorial;
    }
    
    function BorrarEditorial(Request $req){
        $clave = $req->input('clave');
        $clave = (int) $clave;
        $editorial = Editorial::find($clave);
        if($editorial->TieneLibro()){
            return 'no';
        }
        $editorial->delete();
        return $editorial;
    }
}

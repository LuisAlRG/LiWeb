<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{
    /**
     * Autor
     * idAutor
     * nombre
     * apellido
     */
    //funciones de vistas
    function ViewAutores(){
        return view('pantallaAutor',['mensajeServidor'=>null]);
    }

    function VerTodosAutores(){
        $autores = Autor::all();
        return $autores;
    }

    function ConsultarAutor(Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        $apellido = $req->input('apellido');

        if(is_numeric($clave)){
            $elemento = Autor::find($clave);
            return [0=>$elemento];
        }
        $elementos = Autor::where('nombre','LIKE','%'.$nombre.'%')
            ->where('apellido','LIKE','%'.$apellido.'%')
            ->get();
        return $elementos;
    }

    function InsertarAutor(){
        $nombre = $req->input('nombre');
        $apellido = $req->input('apellido');

        $elemento = Autor::where('nombre','=',$nombre)
            ->where('apellido','=',$apellido)
            ->get();
        if(count($elemento)){
            return 're';
        }
        $autor = new Autor();
        $autor->nombre = $nombre;
        $autor->apellido = $apellido;
        $autor->save();
        return $autor;
    }

    function ModificarAutor(){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        $apellido = $req->input('apellido');
        $clave = (int) $clave;

        $elementos = Autor::where('nombre','=',$nombre)
            ->where('apellido','=',$apellido)
            ->get();
        if(count($elementos)){
            foreach($elementos as $key => $elemento){
                if($elemento->idAutor != $clave)
                    return 're';
            }            
        }
        $autor = Autor::find($clave);
        $autor->nombre = $nombre;
        $autor->apellido = $apellido;
        $autor->save();
        return $autor;
    }

    function EliminarAutor(){
        $clave = $req->input('clave');
        $clave = (int) $clave;
        $autor = Autor::find($clave);
        
    }

    
}

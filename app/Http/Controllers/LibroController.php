<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibroController extends Controller
{
	/*
	Modelo Libro
	idLibro
	idEditorial
	titulo
	precio
	edicion
	cantidad
	*/
    //funciones nesesario
    function VerTodosLibros(){
    	return Libro::all();
    }
    function ConsultarLibro(){

    }
    function InsertarLibro(Request $req){
    	
    	$tituloLibro = $req->input('tituloLibroA');
    	$completoAutor = $req->input('autorLibroA');
    	$nombreAutor = null;
    	$apellidoAutor = "";
    	if(str_contains($completoAutor, '-')){
    		$completoAutor = explode("-",$completoAutor);
    		$nombreAutor = $completoAutor[0];
    		if(count($completoAutor)>2)
    			$apellidoAutor = $completoAutor[1];
    	}
    	else{
    		$nombreAutor = $completoAutor;
    	}
    	$nombreEditorial = $req->input('editorialLibroA');
    	$nombreGenero = $req->input('generoLibroA');
    	$precioLibro = $req->input('precioLibroA');
    	$cantidad = 1;

    	$editorial = Editorial::where('nombre',$nombreEditorial)->get();
    	/*
		DB::table('Editorial')
			->where('nombre','like',$atributo)
			->get();
    	*/
    	if(!$editorial){
    		$editorial = new Editorial();
    		$editorial->nombre = $nombreEditorial;
    		$editorial->save();
    	}
    	$autor = Autor::where('nomnre',$nombreAutor)->where('apellido',$apellidoAutor)->get();
    	if(!$autor){
    		$autor = new Autor();
    		$autor->nombre = $nombreAutor;
    		$autor->apellido = $apellidoAutor;
			$autor->save();
    	}
    	$genero = Genero::where('nombre',$nombreGenero)->get();
    	if(!$genero){
    		$genero = new Genero();
    		$genero->nombre = $nombreGenero;
			$genero->save();
    	}

    	$nuevoLibro = new Libro();
    	$nuevoLibro->idEditorial = $editorial->idEditorial;
    	$nuevoLibro->titulo = $tituloLibro;
    	$nuevoLibro->precio = $precioLibro;
    	$nuevoLibro->edicion = 1;
    	$nuevoLibro->cantidad = 1;
    }
    function ModificarLibro(){

    }
    function EliminarLibro(){

    }

}

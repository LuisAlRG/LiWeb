<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

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
	//funciones de vista
	function ViewLibros(){
		return view('pantallaLibro',['mensajeServidor'=>null]);
	}
	function ViewLibroModificar(Request $req){
		$clave = $req->input('clave');
		$clave = (int) $clave;
		$libro = Libro::find($clave);
		$editorial = $libro->editorial()->get()[0];
		return view('pantallaLibroModificado',
			[
				'mensajeServidor'	=>null,
				'libro'				=>$libro,
				'editorial'			=>$editorial
			]
		);
	}
    //funciones nesesario
    function VerTodosLibros(){
		$libros = Libro::all();
		if($libros){
            foreach($libros as $key => $libro){
                $libro = $this->PrepararLibro($libro);
            }
        }
    	return $libros;
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

	//funciones para esa clase
	function PrepararLibro($libro){
		$libro->autores = $libro->autores()->get();
        $libro->editorial = $libro->editorial()->get()[0]->nombre;
	}
}

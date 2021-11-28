<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editorial;
use App\Models\AutorLibro;
use App\Models\GeneroLibro;

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
		$clave = $req->input('thisLibroId');
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
    		$nombreAutor = trim($completoAutor[0]);
    		if(count($completoAutor)>2)
    			$apellidoAutor = trim($completoAutor[1]);
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

    function ModificarLibro(Request $req){
		$idLibro = $req->input('idLibro');
		$titulo = $req->input('titulo');
		$precio = $req->input('precio');
		$edicion = $req->input('edicion');
		$cantidad = $req->input('cantidad');
		$idEditorial = $req->input('idEditorial');
		$nombre = $req->input('nombre');

		$idLibro = (int) $idLibro;
		$libro = Libro::find($idLibro);
		$libro->titulo = 	$titulo;
		$libro->precio = 	$precio;
		$libro->edicion = 	$edicion;
		$libro->cantidad = 	$cantidad;
		
		if(is_numeric($idEditorial)){
			$idEditorial = (int)$idEditorial;
			$editorial = Editorial::find($idEditorial);
			if($editorial){
				$libro->idEditorial = $idEditorial;
			}
			else{
				$elementos = Editorial::where('nombre','=',$nombre)->get();
				if(count($elementos)){
					$editorial = $elementos[0];
					$idEditorial = $editorial->idEditorial;
				}
				else{
					$editorial = new Editorial();
					$editorial->nombre=$nombre;
					$editorial->save();
					$idEditorial = $editorial->idEditorial;
				}
			}
		}
		else{
			$elementos = Editorial::where('nombre','=',$nombre)->get();
			if(count($elementos)){
				$editorial = $elementos[0];
				$idEditorial = $editorial->idEditorial;
			}
			else{
				$editorial = new Editorial();
				$editorial->nombre = $nombre;
				$editorial->save();
				$idEditorial = $editorial->idEditorial;
			}
		}
		$libro->idEditorial = $idEditorial;
		$libro->save();
		$editorial = $libro->editorial()->get()[0];
		return [
			'libro'				=>$libro,
			'editorial'			=>$editorial
		];
    }

    function EliminarLibro(){

    }

	//pantalla modificar libro
	function SuAutores(Request $req){
		$idLibro = 	$req->input('clave');
		$idLibro = (int)$idLibro;
		$libro = Libro::find($idLibro);
		$autores = $libro->autores()->get();
		return $autores;
	}

	function SuGeneros(Request $req){
		$idLibro = 	$req->input('clave');
		$idLibro = (int)$idLibro;
		$libro = Libro::find($idLibro);
		$generos = $libro->generos()->get();
		return $generos;
	}

	function AderirAutor(Request $req){
		$idLibro = 	$req->input('idLibro');
		$clave = 	$req->input('clave');
		$nombre = 	$req->input('nombre');
		$apellido =	$req->input('apellido');

		$idLibro = (int)$idLibro;
		$libro = Libro::find($idLibro);
		$nombre = trim($nombre);
		$apellido = trim($apellido);

		if(is_numeric($clave)){
			$clave = (int) $clave;
            $elemento = Autor::find($clave);
			if($elemento){
				if($this->ExaminarAutor($libro->idLibro,$elemento->idAutor))
					return 're';
				$libro->autores()->save($elemento);
				return $elemento;
			}
		}

		/*
		$apellido = '';
		if(str_contains($nombre,'-') || str_contains($nombre,'-')){
			$nombreCompleto = explode("-",$nombre);
			$nombre = trim($nombreCompleto[0]);
			$apellido = trim($nombreCompleto[1]);
		}
		else{
			$nombre = trim($nombre);
		}
		*/

		$elementos = Autor::where('nombre','=',$nombre)
			->where('apellido','=',$apellido)
			->get(); 
		if(count($elementos)){
			$elemento = $elementos[0];
			if($this->ExaminarAutor($libro->idLibro,$elemento->idAutor))
				return 're';
			$libro->autores()->save($elemento);
			return $elemento;
		}

		$autor = new Autor();
		$autor->nombre = $nombre;
		$autor->apellido = $apellido;
		$autor->save();

		return $autor;
	}

	function QuitarAutor(Request $req){
		$idLibro = 	$req->input('idLibro');
		$clave = 	$req->input('clave');
		$idLibro =	(int)$idLibro;
		$clave = 	(int)$clave;
		$libro = Libro::find($idLibro);
		$autor = Autor::find($clave);
		if($autor){
			$examinar = $libro->autores()->get();
			if(count($examinar) <= 1){
				return "no";
			}
			$libro->autores()->detach($clave);
			return true;
		}
		return false;
	}

	function AderirGenero(Request $req){
		$idLibro = 	$req->input('idLibro');
		$clave = 	$req->input('clave');
		$nombre = 	$req->input('nombre');

		$idLibro = (int)$idLibro;
		$libro = Libro::find($idLibro);

		if(is_numeric($clave)){
			$clave = (int)$clave;
			$elemento = Genero::find($clave);
			if($elemento){
				if($this->ExaminarGenero($libro->idLibro,$elemento->idGenero))
					return 're';
				$libro->generos()->save($elemento);
				return $elemento;
			}
		}

		$nombre = trim($nombre);
		$elementos = Genero::where('nombre','=',$nombre)
			->get();
		if(count($elementos)){
			$elemento = $elementos[0];
			if($this->ExaminarGenero($libro->idLibro,$elemento->idGenero))
				return 're';
			$libro->generos()->save($elemento);
			return $elemento;
		}

		$genero = new Genero();
		$genero->nombre = $nombre;
		$genero->save();
		return $genero;
	}
	
	function QuitarGenero(Request $req){
		$idLibro = 	$req->input('idLibro');
		$clave = 	$req->input('clave');
		$idLibro =	(int)$idLibro;
		$clave = 	(int)$clave;
		$libro = Libro::find($idLibro);
		$genero= Genero::find($clave);
		if($genero){
			$examinar = $libro->generos()->get();
			if(count($examinar) <= 1){
				return "no";
			}
			$libro->generos()->detach($clave);
			return true;
		}
		return false;
	}
	//funciones para esa clase
	//metodo que prepara el libro para la pantalla requiero un pco mas de datos
	function PrepararLibro($libro){
		$libro->autores = $libro->autores()->get();
        $libro->editorial = $libro->editorial()->get()[0]->nombre;
	}
	//metodo que revisa si ya exite autor relacionado al libro
	function ExaminarAutor($idLibro,$idAutor){
		$examinar= AutorLibro::where('idLibro',"=",$idLibro)
				->where('idAutor',"=",$idAutor)
				->get();
		return count($examinar);
	}
	//metodo que revisa si ya existe Genero relacionado al libro
	function ExaminarGenero($idLibro,$idGenero){
		$examinar= GeneroLibro::where('idLibro',"=",$idLibro)
				->where('idGenero',"=",$idGenero)
				->get();
		return count($examinar);
	}
}

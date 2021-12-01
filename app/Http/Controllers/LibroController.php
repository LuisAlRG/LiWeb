<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editorial;
use App\Models\AutorLibro;
use App\Models\GeneroLibro;
use App\Models\Historial;
use Illuminate\Support\Facades\Auth;

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
		$ruta = '';
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();

        $puesto = $empleado->QueEs();
        if($puesto == 1){
            $ruta = 'funcionario.';
        }

		return view($ruta.'pantallaLibro',['mensajeServidor'=>null]);
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
/*
    function ConsultarLibro1(Request $req){
		$clave = 		$req->input('clave');
		$edicion = 		$req->input('edicion');
		$precio = 		$req->input('precio');
		$categoria = 	$req->input('categoria');
		$titulo = 		$req->input('titulo');
		$nombreAutor = 	$req->input('autor');
		$nombreEditorial = $req->input('editorial');
		$nombreGenero = $req->input('genero');

		$categoria = (int)$categoria;
		
		if(is_numeric($clave)){
            $clave = (int) $clave;
            $elemento = Libro::find($clave);
			$elemento = $this->PrepararLibro($elemento);
            return [0=>$elemento];
        }
		if(is_numeric($precio)){
			$precio = (int) $precio;
		}
		else{
			$precio = 0;
			$categoria = 1;
		}
		$opCategoria = '!=';
		switch($categoria){
			case 1: $opCategoria='>='; break; //mayor que
			case 2: $opCategoria='<='; break; //menor que
		}
		
		
		$elementos = Libro::where('titulo','LIKE','%'.$titulo.'%')
			->where('precio',$opCategoria,$precio)
			->get();
			
		if(count($elementos)){
            foreach($elementos as $key => $libro){
				//echo $libro;
				
                $libro = $this->PrepararLibro($libro);
            }
        }
		$elementos = $elementos->toArray();
		$listaFinal = array_filter($elementos,function($var){
			//primero revisar si hay autor con ese nombre o apellido
			$pasableAutor = false;
			if(isset($nombreAutor) || !(trim($nombreAutor??'') === '')){
				$listAutor = $var->autores()->get();
				foreach($listAutor as $key => $elAutor){
					$pasableAutor = str_contains($elAutor->nombre, $nombreAutor) || 
					str_contains($elAutor->apellido, $nombreAutor);
					if($pasableAutor)
						break;
				}
			}
			else{
				$pasableAutor = true;
			}
			//revisar si hay editorial con ese libro
			$pasableEditorial = false;
			if(isset($nombreEditorial) || !(trim($nombreEditorial??'') === '')){
				$listEditorial = $var->editorial()->get();
				foreach($listEditorial as $key => $elEditorial){
					$pasableEditorial = str_contains($elEditorial->nombre, $nombreEditorial);
					if($pasableEditorial)
						break;
				}
			}
			else{
				$pasableEditorial = true;
			}
			//revisar si hay generos con ese nombre
			$pasableGenero = false;
			if(isset($nombreGenero) || !(trim($nombreGenero??'') === '')){
				$listGenero = $var->generos()->get();
				foreach($listGenero as $key => $elGenero){
					$pasableGenero  = str_contains($elGenero->nombre, $nombreGenero);
					if($pasableGenero)
						break;
				}
			}
			else{
				$pasableGenero = true;
			}
			$pasable = $pasableAutor && $pasableEditorial && $pasableGenero;
			return $pasable;
		});
		
		return $listaFinal;
    }
*/
	function ConsultarLibro(Request $req){
		$clave = 		$req->input('clave');
		$edicion = 		$req->input('edicion');
		$precio = 		$req->input('precio');
		$categoria = 	$req->input('categoria');
		$titulo = 		$req->input('titulo');
		$nombreAutor = 	$req->input('autor');
		$nombreEditorial = $req->input('editorial');
		$nombreGenero = $req->input('genero');

		$categoria = (int)$categoria;
		
		if(is_numeric($clave)){
            $clave = (int) $clave;
            $elemento = Libro::find($clave);
			if($elemento){
				$elemento->autores = 	$elemento->autores()->get();
				$elemento->genero = 	$elemento->generos()->get();
				$elemento->editorial = 	$elemento->editorial()->get()[0]->nombre;
			}
            return [0=>$elemento];
        }
		if(is_numeric($precio)){
			$precio = (int) $precio;
		}
		else{
			$precio = 0;
			$categoria = 1;
		}
		$opCategoria = '!=';
		switch($categoria){
			case 1: $opCategoria='>='; break; //mayor que
			case 2: $opCategoria='<='; break; //menor que
		}

		$elementos = Libro::where('Libro.titulo','LIKE','%'.$titulo.'%')
			->where('Libro.precio',$opCategoria,$precio);
		if(isset($nombreAutor) || !(trim($nombreAutor??'') === '')){
			$elementos->join('AutorLibro', function($join1) use ($nombreAutor){
				$join1->on('Libro.idLibro','=','AutorLibro.idLibro')
					->join('Autor',function($join2) use ($nombreAutor){
						$join2->on('AutorLibro.idAutor','=','Autor.idAutor')
							->where('Autor.nombre','LIKE','%'.$nombreAutor.'%')
							->orwhere('Autor.apellido','LIKE','%'.$nombreAutor.'%');
					});
			});
		}

		if(isset($nombreEditorial) || !(trim($nombreEditorial??'') === '')){
			$elementos->leftJoin('Editorial','Libro.idEditorial','=','Editorial.idEditorial')
				->where('Editorial.nombre','LIKE','%'.$nombreEditorial.'%')
			;
		}

		if(isset($nombreGenero) || !(trim($nombreGenero??'') === '')){
			$elementos->join('GeneroLibro','Libro.idLibro','=','GeneroLibro.idLibro')
				->leftJoin('Genero','GeneroLibro.idGenero','=','Genero.idGenero')
				->where('Genero.nombre','LIKE','%'.$nombreGenero.'%')
			;
		}
		$elementos = $elementos->get();

		if(count($elementos)){
            foreach($elementos as $key => $libro){
                $libro = $this->PrepararLibro($libro);
            }
        }

		return $elementos;
	}

    function InsertarLibro(Request $req){
    	$tituloLibro = $req->input('titulo');
    	$completoAutor = $req->input('autor');
    	$nombreEditorial = $req->input('editorial');
    	$nombreGenero = $req->input('genero');
    	$precioLibro = $req->input('precio');
    	$cantidad = 1;
		$nombreAutor = "";
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

    	$editorial = Editorial::where('nombre','=',$nombreEditorial)->first();
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
    	$autor = Autor::where('nombre','=',$nombreAutor)->where('apellido','=',$apellidoAutor)->first();
    	if(!$autor){
    		$autor = new Autor();
    		$autor->nombre = $nombreAutor;
    		$autor->apellido = $apellidoAutor;
			$autor->save();
    	}
    	$genero = Genero::where('nombre','=',$nombreGenero)->first();
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
		$nuevoLibro->save();
		$nuevoLibro->generos()->save($genero);
		$nuevoLibro->autores()->save($autor);

		$usuario = Auth::user();
		if($usuario){
			$empleado = $usuario->empleado()->first();
			$historial = new Historial();
			$historial->idEmpleado = $empleado->idEmpleado;
			$historial->operacion = "Agrego libro: ".$nuevoLibro->nuevoLibro;
			$historial->save();
		}

		return $nuevoLibro;
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

		$usuario = Auth::user();
		if($usuario){
			$empleado = $usuario->empleado->first();
			$historial = new Historial();
			$historial->idEmpleado = $empleado->idEmpleado;
			$historial->operacion = "Modifico libro: ".$libro->titulo;
			$historial->save();
		}

		$editorial = $libro->editorial()->get()[0];
		return [
			'libro'				=>$libro,
			'editorial'			=>$editorial
		];
    }

    function BorrarLibro(Request $req){
		
		$clave = $req->input('clave');
        $clave = (int)$clave;
		$libro = Libro::find($clave);
		$tieneVenta = $libro->ventas()->get();
		if(count($tieneVenta)){
			return 'no';
		}
		$libro->delete();

		$usuario = Auth::user();
		if($usuario){
			$empleado = $usuario->empleado->first();
			$historial = new Historial();
			$historial->idEmpleado = $empleado->idEmpleado;
			$historial->operacion = "Elimino libro: ".$libro->titulo;
			$historial->save();
		}
        

		return $libro;
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
		$libro->autores = 	$libro->autores()->get();
		$libro->genero = 	$libro->generos()->get();
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AutorLibro;
use App\Models\AutorGenero;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'Libro';
	protected $primaryKey = 'idLibro';

    public function editorial(){
    	return $this->belongsTo(Editorial::class,'idEditorial');
    }

	public function ventas(){
		return $this->hasMany(VentaLibro::class,'idLibro');
	}

    public function generos(){

    	return $this->belongsToMany(Genero::class,'GeneroLibro',
    		'idLibro',
			'idGenero'
    	);
    }

    public function autores(){
        return $this->belongsToMany(Autor::class,'AutorLibro',
			'idLibro',
			'idAutor'
        );
    }

	public function SaveAutor($autor){
		$existe = AutorLibro::where('idLibro','=',$this->idLibro)
			->where('idAutor','=',$autor->idAutor)->first();
		if($existe){
			return 1;
		}
		$this->autores()->save($autor);
		return 0;
	}

	public function SaveGenero($genero){
		$existe = GeneroLibro::where('idLibro','=',$this->idLibro)
			->where('idGenero','=',$genero->idGenero)->first();
		if($existe){
			return 1;
		}
		$this->generos()->save($genero);
		return 0;
	}

	
}

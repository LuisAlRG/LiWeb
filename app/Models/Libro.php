<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'Libro';

    public function editorial(){
    	return $this->belongsTo(Editorial::class,'idEditorial');
    }

    public function generos(){
    	/*
    	return $this->hasManyThrough(
    		Genero::class,		//clase conecato
    		GeneroLibro::class,	//clase intermedio
    		'idLibro',			//clave foranea de la intermedio
    		'idGenero',			//clave foranea de la intermedio
    		'idLibro',			//id 
    		'idGenero'
    	);
    	*/
    	return $this->belongsToMany(Genero::class,'GeneroLibro',
    		'idLibro',
    		'idGenero'
    	);
    }

    public function Autores(){
        return $this->belongsToMany(Autor::class,'GeneroLibro',
            'idLibro',
            'idAutor'
        );
    }
}

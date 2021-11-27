<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $table = 'Genero';
    protected $primaryKey = 'idGenero';

    public function generoLibro(){
        return $this->hasMany(GeneroLibro::class,'idGenero');
    }

    public function TieneLibro(){
        $element = $this->generoLibro()->get();
        if(count($element)){
            return true;
        }
        return false;
    }
}

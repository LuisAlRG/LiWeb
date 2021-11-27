<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'Autor';
    protected $primaryKey = 'idAutor';

    public function autorLibro(){
        return $this->hasMany(AutorLibro::class,'idAutor');
    }

    public function TieneLibro(){
        $element = $this->autorLibro()->get();
        if(count($element)){
            return true;
        }
        return false;
    }
}

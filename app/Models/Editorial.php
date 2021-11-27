<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;
    protected $table = 'Editorial';
    protected $primaryKey = 'idEditorial';

    public function lirbos(){
        return $this->hasMany(Libro::class,'idEditorial');
    }

    public function TieneLibro(){
        $element = $this->lirbos()->get();
        if(count($element)){
            return true;
        }
        return false;
    }

}

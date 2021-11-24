<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VentaLibro;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'Venta';
    protected $primaryKey = 'idVenta';

    public function libros(){
        return $this->belongsToMany(Libro::class,'VentaLibro',
            'idVenta',
            'idLibro'
        )->withPivot('cantidad');
    }

    public function responsable(){
        return $this->belongsTo(Empleado::class,'idEmpleado');
    }

    public function SaveLibroCant($libro,$cantidad){

        if(!is_numeric($libro)){
            $libro = $libro->idLibro;
        }

        $this->libros()->attach($libro,['cantidad'=>$cantidad]);
        $relacion = VentaLibro::where('idVenta','=',$this->idVenta)
            ->where('idLibro','=',$libro)->first();
        
        return $relacion;
    }
    public function getResponsable(){
        $empleado = $this->responsable()->get()[0];
        return $empleado->nombre.' - '.$empleado->apellido;
    }

    public function PrecioTotal(){
        $total = 0.00;
        $lirbos = $this->libros()->get();
        if($lirbos){
            foreach($lirbos as $key => $libro ){
                $total += $libro->precio * $libro->pivot->cantidad;
            }
        }
        
        return $total;
    }
}

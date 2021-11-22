<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;
use App\Models\Administrador;


class Empleado extends Model
{
    use HasFactory;
    protected $table = 'Empleado';
	protected $primaryKey = 'idEmpleado';

    public function user(){
    	return $this->belongsTo(User::class,'idUser');
    }

    public function funcionario(){
    	return $this->hasOne(Funcionario::class,'idEmpleado');
    }
    public function administrador(){
		return $this->hasOne(Administrador::class,'idEmpleado');
    }

    public function QueEs(){
    	$element = $this->funcionario();
    	if($element){
    		return 1;
    	}
    	$element = $this->administrador();
    	if($element){
    		if($element->gerente)
    			return 3;
    		return 2;
    	}
    	return -1;
    }

    public function ConvertirA($tipoDeUsuario){
    	//1 funcionario
    	//2 administrador
    	//3 gerente
    	$contratado = true;
    	$element = $this->funcionario();
		if($element){
			$contratado = $element->contratado;
    		$this->administrador()->delete();
    	}
    	$element = $this->administrador();
    	if($element){
    		$contratado = $element->contratado;
    		$this->administrador()->delete();
    	}

    	switch($tipoDeUsuario){
    		case 1:
    			$funci = new Funcionario();
				$funci->contratado = $contratado;
				$funci->idEmpleado = $this->idEmpleado;
				$funci->save();
    		break;
    		case 2:
    			$admin = new Administrador();
    			$admin->contratado = $contratado;
    			$admin->gerente = false;
				$admin->idEmpleado = $this->idEmpleado;
				$admin->save();
    		break;
    		case 3:
    			$admin = new Administrador();
    			$admin->contratado = $contratado;
    			$admin->gerente = true;
				$admin->idEmpleado = $this->idEmpleado;
				$admin->save();
    		break;
    		default:
    			return false;
    	}

    	return True;
    }
}

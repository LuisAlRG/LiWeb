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

	public function ventas(){
		return $this->hasOne(Venta::class,'idEmpleado');
	}

	public function historial(){
		return $this->hasMany(Historial::class,'IdEmpleado');
	}

    public function QueEs(){
    	$element = $this->funcionario()->get();
    	if(count($element)){
    		return 1;
    	}
    	$element = $this->administrador()->get();
    	if(count($element)){
    		if($element[0]->gerente)
    			return 3;
    		return 2;
    	}
    	return -1;
    }

	public function getContratado(){
		$element = $this->funcionario()->get();
    	if(count($element)){
    		return $element[0]->contratado;
    	}
    	$element = $this->administrador()->get();
    	if(count($element)){
    		return $element[0]->contratado;
    	}
    	return false;
	}

	public function getResponsable(){
		$element = $this->ventas()->get();
		if(count($element)){
			return true;
		}
		return false;
	}

	public function toggleContratado($boleano){
		$element = $this->funcionario()->get();
    	if(count($element)){
    		$element[0]->contratado = !$boleano;
			$element[0]->save();
			return !$boleano;
    	}
    	$element = $this->administrador()->get();
    	if(count($element)){
    		$element[0]->contratado = !$boleano;
			$element[0]->save();
			return !$boleano;
    	}
    	return '1';
	}

    public function ConvertirA($tipoDeUsuario){
    	//1 funcionario
    	//2 administrador
    	//3 gerente
    	$contratado = true;
    	$element = $this->funcionario()->get();
		if(count($element)){
			$contratado = $element[0]->contratado;
    		$this->funcionario()->delete();
    	}
    	$element = $this->administrador()->get();
    	if(count($element)){
    		$contratado = $element[0]->contratado;
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

	public function BorrarPertenencia(){
		$element = $this->funcionario()->get();
		if(count($element)){
    		$element[0]->delete();
    	}
    	$element = $this->administrador()->get();
    	if(count($element)){
    		$element[0]->delete();
    	}
	}
}

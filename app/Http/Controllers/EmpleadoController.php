<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class EmpleadoController extends Controller
{
    //funcion de vistas
    function ViewLogIn(){
        return view('logIn',['mensajeServidor'=>null]);
    }
    function ViewMenoPrincipal(){
        return view('menuPrincipal');
    }
    // funciones de peticion 
    function Autenticar(Request $req){
        $name = $req->input('nombreUsuario');
        $pass = $req->input('contrasena');

        $user = User::where('name',$name)->get();
        if($user){
            foreach ($user as $key => $value) {
                if(Hash::check($pass, $value->password)){
                    Auth::login($value);
                    return redirect('/LiWeb/MenuPrincipal');
                }
            }
        }
        return view('logIn',['mensajeServidor'=>'Usuario no encontrado']);
    }
    function Salir(){
        Auth::logout();
        return redirect('/LiWeb');
    }
}

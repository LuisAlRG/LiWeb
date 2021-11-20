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

        if (isset($_POST["btnSubmit"]))
        {
            $secret = "6LcBh0cdAAAAAKAPnyuz_CnfI1661m_vwgD_AzxX";
            $response = $_POST['g-recaptcha-response'];
            $respuesta = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=127.0.0.1"));
            if (!$respuesta->success)
            {
                return view('logIn',['mensajeServidor'=>'El captcha fue rechasado, vuelve a intentar']);
            }
        }

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

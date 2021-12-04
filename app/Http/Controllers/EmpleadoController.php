<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class EmpleadoController extends Controller
{
    //funcion de vistas
    // /LiWeb
    function ViewLogIn(){
        return view('logIn',['mensajeServidor'=>null]);
    }
    // /LiWeb/MenuPrincipal
    function ViewMenuPrincipal(){
        $ruta = '';
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();

        $puesto = $empleado->QueEs();
        if($puesto == 1){
            $ruta = 'funcionario.';
        }

        return view( $ruta.'menuPrincipal' );
    }
    // /LiWeb/Empleados
    function ViewEmpleados(){
        return view('pantallaEmpleado');
    }
    // funciones de peticion 
    function Autenticar(Request $req){

        /*
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
        */

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
        return view('logIn',['mensajeServidor'=>'Usuario o clave incorrecta, intente de nuevo']);
    }
    function Salir(){
        Auth::logout();
        return redirect('/LiWeb');
    }

    // /Empleados/VerTodoEmpleado
    function VerTodoEmpleado(){
        $empleados = Empleado::all();
        if($empleados){
            foreach($empleados as $key => $empleado){
                //$empleado->rol = $empleado->QueEs();
                //$empleado->contratado = $empleado->getContratado();
                $empleado = $this->PrepararEmpleado($empleado);
            }
        }
        return $empleados;
    }

    // /Empleados/Contratado
    function Contratar(Request $req){
        $clave =   $req->input('clave');
        $contratado =   $req->input('contratado');
        $clave = (int)$clave;
        $empleado = Empleado::find($clave);
        
        return $empleado->toggleContratado($contratado);
        
    }

    // /Empleados/Consultar
    function ConsultarEmpleado(Request $req){
        $clave = $req->input('clave');
        $nombre = $req->input('nombre');
        $apellido = $req->input('apellido');
        $rolSelect = $req->input('rolSelect');
        $rolSelect = (int)$rolSelect;
        if(is_numeric($clave??'')){
            $clave = (int)$clave;
            $elemento = Empleado::find($clave);
            if($elemento ){
                
                $elemento = $this->PrepararEmpleado($elemento);
            }
            return [0=>$elemento];
        }
        $elementos = Empleado::where('nombre','LIKE','%'.$nombre.'%')
            ->where('apellido','LIKE','%'.$apellido.'%')
            ->get();
        $empleadosSent=[];
        foreach($elementos as $key => $empleado){
            $empleado = $this->PrepararEmpleado($empleado);
            if($rolSelect>0)
            {
                if( $empleado->QueEs() == $rolSelect)
                    $empleadosSent[] = $empleado;
            }
            else{
                $empleadosSent[] = $empleado;
            }
        }

        return $empleadosSent;
    }
    // /Empleados/Insertar
    function InsertarUsuario(Request $req){
        $nombre =   $req->input('nombreEmpleado');
        $apellido = $req->input('apellidoEmpleado');
        $password = $req->input('passEmpleado');
        $rol =      $req->input('rolEmpleado');
        $rol = (int) $rol;

        $existe = User::where('name','=',$nombre)->get();
        if($existe){
            //revisar si concuerda con un usuario
            foreach ($existe as $key => $value) {
                if(Hash::check($password, $value->password)){
                    return 're';
                }
            }
        }

        $contarID = Empleado::count();

        $empleado = new Empleado();
        $empleado->nombre = $nombre;
        $empleado->apellido = $apellido;
        $usuario = new User();
        $usuario->name = $empleado->nombre;
        $usuario->email = "liWeb".$contarID.$empleado->apellido."@192.168.1.150";
        $usuario->password = Hash::make( $password );
        $usuario->save();
        $usuario->empleado()->save($empleado);
        $empleado->ConvertirA($rol);
        $empleado->save();

        $sentEmpleado = $this->PrepararEmpleado($empleado);

        return $sentEmpleado;
    }

    // /Empleados/Modificar
    function ModificarUsuario(Request $req){
        $clave = $req->input('clave');
        $nombre =   $req->input('nombre');
        $apellido = $req->input('apellido');
        $password = $req->input('password');
        $rol =      $req->input('rol');
        $clave = (int) $clave;
        $rol = (int) $rol;

        $existe = User::where('name','=',$nombre)->get();
        if($existe){
            //revisar si concuerda con un usuario
            foreach ($existe as $key => $value) {
                if(Hash::check($password, $value->password)){
                    if($value->idEmpleado != $clave)
                    return 're';
                }
            }
        }

        $empleado = Empleado::find($clave);
        $empleado->nombre = $nombre;
        $empleado->apellido = $apellido;
        $usuario = User::find($empleado->idUser);
        $usuario->name = $nombre;
        if( isset($password) || !(trim($password) === '')){
            $usuario->password = Hash::make( $password );
        }
        $usuario->save();
        $empleado->ConvertirA($rol);
        $empleado->save();

        return 'ok';
    }

    // /Empleados/Borrar
    function BorrarEmpleado(Request $req){
        $clave = $req->input('clave');
        $clave = (int)$clave;
        $empleado = Empleado::find($clave);
        if($empleado->getResponsable()){
            return 'no';
        }
        $user = $empleado->user()->get();
        $empleado->BorrarPertenencia();
        $empleado->delete();
        $user[0]->delete();
        
        return $empleado;
    }

    public function PrepararEmpleado($empleado){
        $empleado->rol = $empleado->QueEs();
        $empleado->contratado = $empleado->getContratado();
        return $empleado;
    }
}

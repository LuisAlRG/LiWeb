<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Empleado;

class NivelEmpleado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        $ruta = '';
        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();
        $puesto = $empleado->QueEs();
        if($puesto == 1){
            $ruta = 'funcionario.';
        }
        $req->merge(['nivelEmpleado' => $ruta]);
        return $next($req);
    }
}

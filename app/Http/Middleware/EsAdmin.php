<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsAdmin
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

        $usuario = Auth::user();
        $empleado = $usuario->empleado()->first();

        $puesto = $empleado->QueEs();
        if($puesto == 1){
            return redirect('/LiWeb/MenuPrincipal');
        }

        return $next($req);
    }
}

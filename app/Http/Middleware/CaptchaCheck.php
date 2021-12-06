<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CaptchaCheck
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
        if ($req->has('btnSubmit'))//isset($_POST["btnSubmit"]))
        {
            $secret = "6LcBh0cdAAAAAKAPnyuz_CnfI1661m_vwgD_AzxX";
            $response = $req->input('g-recaptcha-response');//$_POST['g-recaptcha-response'];
            $respuesta = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=127.0.0.1"));
            if (!$respuesta->success)
            {
                return view('logIn',['mensajeServidor'=>'El captcha fue rechasado, vuelve a intentar']);
            }
        }
        return $next($req);
    }
}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/logInStyle.css">
    <title>LiWeb</title>
</head>
<body>
    <div>
        <logIn>
            <div id="parteIzquierdo">
                <figure>
                    <img src="/img/Logo.png" alt="Logotipo de LiWeb">
                </figure>
            </div>
            <div id="parteDerecha">
                <form action="/LiWeb/Autenticar" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }} " ng-model="tokenUsr">
                    <label for="nombreUsuario">Nombre</label>
                    <input type="text" name="nombreUsuario" id="nombreUsuario">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena">
                    <input type="submit" value="Entrar">
                    
                </form>
                <p><span>{{$mensajeServidor}}</span></p>
                <p>Si usted todavia no a sido registrado</p>
                <p>Espere a que un Administrador lo de de alta</p>

            </div>
        </logIn>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <!-- css -->
    <link rel="stylesheet" href="/css/principalStyle.css">
    <link rel="stylesheet" href="/css/svgAnimaciones.css">
    @yield('style')
    <!-- librerias  -->
    <script src="/js/angular.min.js"></script>
    <script src="/js/jquery.min.js"></script>
</head>
<body ng-app="allApp" ng-controller="allController">
    <!-- Parte Izquierdo-->
    <div id="parteIzquierdo">
        <banerSeccion>
            <!-- Baner Seccion-->
            <div>
                <div id="logo">
                    <img src="/img/Logo.png" alt="">
                </div>
                <div id="tituloSeccion">
                    @yield('subtitle')
                </div>
                <div class="resetFloat"></div>
            </div>
        </banerSeccion>
        <accionesInputs>
            <!-- Acciones de Inputs-->
            @yield('accinesInputs')
        </accionesInputs>

        <botonesDeAccion>
            <!--Botones de acciones-->
            @yield('botonesAccion')
        </botonesDeAccion>
    </div>
    <!-- Parte Derecho-->
    <div id="parteDerecho">
        <!-- Tablas o formas-->
        @yield('tables')
    </div>

    
</body>

<!--script del final-->
@yield('script')


</html>
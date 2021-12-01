@extends('layouts.pant')

@section('titleAll','Generos')

@section('title')
	<title>LiWeb Generos</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloGeneros.css">
@endsection
@section('subtitle')
    <p>Libros</p>
	<p>Generos</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarGenero" method="post">
        <label for="clave">Clave</label>
        <input type="number" name="clave" id="clave"
            ng-model="clave"
        >
        <label for="nombre">Nombre</label> 
        <input type="text" name="nombre" id="nombre"
            ng-model="nombre" ng-disabled="DisableIfClave()"
        > 
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
    <div> <button ng-click="OnBuscarGenero()">Buscar</button></div>
    <div> <a href="../Libros"> <button>Regresar</button></a></div>
    <div> <a href="../MenuPrincipal"> <button>Menu</button></a></div> 
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Genero">
            <div class="cel1"> <span>Clave</span> </div>
            <div class="cel2"> <span>Nombre</span> </div>
            <div class="cel3"> <span>Acciones</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Genero element@{{genero.idGenero}}">
                <div class="cel1"><span>@{{genero.idGenero}}</span></div>
                <div class="cel2"><span>@{{genero.nombre}}</span></div>
                <div class="cel3">
                </div>
                <div class="elementComplete">
                    <section>
                        <p>id: @{{genero.idGenero}}</p>
                        <p>Nombre: @{{genero.nombre}}</p>
                    </section>
                </div>
            </section>
            <section id="mensajeVacio" ng-show="listAutores.length == 0">
                <div class="cel1">
                    <span> @{{mensajeVacio}} </span>
                </div>
            </section>
        </div>
        <div class="pieTabla">
            <div>Genero</div>
            <div>Aderrir</div>
            <form name="aGenero" id="aGenero" action="aderirGenero">
                <div>
                    <input type="text" name="nombreGeneroA" id="nombreGeneroA" required 
                        ng-model = "nombreGeneroA"
                    >
                </div>
                <div>
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                        ng-click="OnInsertarGenero()"
                    >
                        <circle class="fondoG" cx="50" cy="50" r="45" fill="#008000"/>
                        <g class="cruzNegraG">
                            <rect x="44" y="20" width="15" height="65" fill="black" fill-opacity="0.4"/>
                            <rect x="85" y="45" width="15" height="65" transform="rotate(90 85 45)" fill="black" fill-opacity="0.4"/>
                        </g>
                        <g class="cruzBlancaG">
                            <rect x="42" y="17" width="15" height="65" fill="white"/>
                            <rect x="83" y="42" width="15" height="65" transform="rotate(90 83 42)" fill="white"/>
                        </g>
                    </svg>
                </div>
            </form>
            <section ng-show="mensajeInsertar">
                <p><span>@{{mensajeInsertar}}</span></p>
            </section>
        </div>
    </div>
</tablaInfo>
@endsection
@section('script')
    <script src="/js/ClasesLocales/Genero.js"></script>
    <script src="/js/mainGeneros.js"></script>
@endsection
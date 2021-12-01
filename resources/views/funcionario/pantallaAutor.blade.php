@extends('layouts.pant')

@section('titleAll','Autores')

@section('title')
	<title>LiWeb Autores</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloAutores.css">
@endsection
@section('subtitle')
    <p>Libros</p>
	<p>Autores</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarAutores" method="post">
        <label for="clave">Clave</label> 
        <input type="number" name="clave" id="clave"
            ng-model="clave"
        > 
        <label for="nombre">Nombre(s)</label>
        <input type="text" name="nombre" id="nombre"
            ng-model="nombre" ng-disabled="DisableIfClave()"
        >
        <label for="apellido">Apellido(s)</label>
        <input type="text" name="apellido" id="apellido"
            ng-model="apellido" ng-disabled="DisableIfClave()"
        >
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
    <div><button ng-click="OnBuscarAutor()">Buscar</button></div>
    <div> <a href="../Libros"> <button>Regresar</button></a></div> 
    <div> <a href="../MenuPrincipal"> <button>Menu</button></a></div> 
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Autor">
            <div class="cel1"> <span>Clave</span> </div>
            <div class="cel2"> <span>Nombre(s)</span> </div>
            <div class="cel3"> <span>Apellido(s)</span> </div>
            <div class="cel4"> <span>Actions</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Autor element@{{autor.idAutor}}">
                <div class="cel1"><span>@{{autor.idAutor}}</span></div>
                <div class="cel2"><span>@{{autor.nombre}}</span></div>
                <div class="cel3"><span>@{{autor.apellido}}</span></div>
                <div class="cel4">
                    
                </div>
                <div class="elementComplete">
                    <section>
                        <p>ID: @{{autor.idAutor}}</p>
                        <p>Nombre: @{{autor.nombre}}</p>
                        <p>Apellido: @{{autor.apellido}}</p>
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
            <div>Nombre</div>
            <div>Apellido</div>
            <div>Aderrir</div>
            <form name="aAutor" id="aAutor" action="aderirAutorOnLibro" method="post">
                <div>
                    <input type="text" name="nombreAutorA" id="nombreAutorA" required 
                        ng-model = "nombreAutorA"
                    >
                </div>
                <div>
                    <input type="text" name="apellidoAutorA" id="apellidoAutorA" required
                        ng-model = "apellidoAutorA"
                    >
                </div>
                <div>
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                        ng-click="OnInsertarAutor()"
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
    <script src="/js/ClasesLocales/Autor.js"></script>
    <script src="/js/mainAutores.js"></script>
@endsection
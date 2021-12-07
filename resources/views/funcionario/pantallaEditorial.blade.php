@extends('layouts.pant')

@section('titleAll','Editoriales')

@section('title')
	<title>LiWeb Editoriales</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloEditoriales.css">
@endsection
@section('subtitle')
    <p>Libros</p>
	<p>Editoriales</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarEditorial" method="post">
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
    <div><button ng-click="OnBuscarEditorial()">Buscar</button></div>
    <div><a href="../Libros"><button>Regresar</button></a></div>
    <div> <a href="../MenuPrincipal"><button>Menu</button></a></div> 
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Editoriales">
            <div class="cel1"> <span>Clave</span> </div>
            <div class="cel2"> <span>Nombre</span> </div>
            <div class="cel3"> <span>Acciones</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Editoriales element@{{editorial.idEditorial}}"
            >
                <div class="cel1"><span>@{{editorial.idEditorial}}</span></div>
                <div class="cel2"><span>@{{editorial.nombre}}</span></div>
                <div class="cel3">
                    
                </div>
                <div class="elementComplete">
                    <section>
                        <p>ID: @{{editorial.idEditorial}}</p>
                        <p>Nombre: @{{editorial.nombre}}</p>
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
            <div>Nombre de Editorial</div>
            <div>Adherir</div>
            <form name="aEditorial" id="aEditorial" action="aderirEditorial">
                <div>
                    <input type="text"  name="nombreEditorialA" id="nombreEditorialA" required 
                        ng-model = "nombreEditorialA"
                    >
                </div>
                <div>
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                        ng-click="OnInsertarEditorial()"
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
    <script src="/js/ClasesLocales/Editorial.js"></script>
    <script src="/js/mainEditoriales.js"></script>
@endsection
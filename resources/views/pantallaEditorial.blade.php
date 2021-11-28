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
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#008000"/>
                        <rect x="58.4264" y="39.4558" width="15" height="50" rx="7.5" transform="rotate(45 58.4264 39.4558)" fill="black" fill-opacity="0.4"/>
                        <circle cx="66.9117" cy="41.5772" r="17.5" transform="rotate(45 66.9117 41.5772)" fill="black" fill-opacity="0.4"/>
                        <rect x="76.1041" y="20.364" width="17" height="19" transform="rotate(45 76.1041 20.364)" fill="#008000"/>
                        <rect x="55.4264" y="34.4558" width="15" height="50" rx="7.5" transform="rotate(45 55.4264 34.4558)" fill="white"/>
                        <circle cx="63.9117" cy="36.5772" r="17.5" transform="rotate(45 63.9117 36.5772)" fill="white"/>
                        <rect x="73.1041" y="15.364" width="17" height="19" transform="rotate(45 73.1041 15.364)" fill="#008000"/>
                    </svg>
                </div>
                <div class="mensageSections" ng-show="MostrarSiMensage();" >
                    <section>
                        <p><span>@{{mensajeModificar}}</span></p>
                        <p><span>@{{mensajeBorrar}}</span></p>
                    </section>
                </div>
                <div class="opcionesAdm">
                    <section>
                        <div>
                            <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle id="Ellipse 1" cx="50" cy="50" r="45" fill="#008000"/>
                                <g id="LapizSombra">
                                <path id="Polygon 1" d="M24.3015 82.6985L31.0258 57.603L49.397 75.9742L24.3015 82.6985Z" fill="black" fill-opacity="0.45"/>
                                <rect id="Rectangle 2" x="44.8076" y="69.2635" width="10" height="45" transform="rotate(-135 44.8076 69.2635)" fill="black" fill-opacity="0.45"/>
                                <rect id="Rectangle 3" x="50.4645" y="74.9203" width="5" height="45" transform="rotate(-135 50.4645 74.9203)" fill="black" fill-opacity="0.45"/>
                                <rect id="Rectangle 4" x="35.6152" y="60.0711" width="5" height="45" transform="rotate(-135 35.6152 60.0711)" fill="black" fill-opacity="0.45"/>
                                <path id="Ellipse 2" d="M65.3137 23.3015C67.7517 20.8635 71.0583 19.4939 74.5061 19.4939C77.9539 19.4939 81.2605 20.8635 83.6985 23.3015C86.1365 25.7395 87.5061 29.0461 87.5061 32.4939C87.5061 35.9417 86.1365 39.2483 83.6985 41.6863L74.5061 32.4939L65.3137 23.3015Z" fill="black" fill-opacity="0.45"/>
                                </g>
                                <g id="Lapiz">
                                <path id="Polygon 1_2" d="M20.3015 78.6985L27.0258 53.603L45.397 71.9742L20.3015 78.6985Z" fill="white"/>
                                <rect id="Rectangle 2_2" x="40.8076" y="65.2635" width="10" height="45" transform="rotate(-135 40.8076 65.2635)" fill="white"/>
                                <rect id="Rectangle 3_2" x="46.4645" y="70.9203" width="5" height="45" transform="rotate(-135 46.4645 70.9203)" fill="white"/>
                                <rect id="Rectangle 4_2" x="31.6152" y="56.0711" width="5" height="45" transform="rotate(-135 31.6152 56.0711)" fill="white"/>
                                <path id="Ellipse 2_2" d="M61.3137 19.3015C63.7517 16.8635 67.0583 15.4939 70.5061 15.4939C73.9539 15.4939 77.2605 16.8635 79.6985 19.3015C82.1365 21.7395 83.5061 25.0461 83.5061 28.4939C83.5061 31.9417 82.1365 35.2483 79.6985 37.6863L70.5061 28.4939L61.3137 19.3015Z" fill="white"/>
                                </g>
                            </svg>
                            <br>
                            Modificar
                        </div>
                        <div>
                            <svg class="boteDeBasura" viewBox="-10 -10 380 510" fill="none" xmlns="http://www.w3.org/2000/svg"
                            ng-click="OnEliminarEditorial(editorial.idEditorial,$index)"
                            >
                                <path class="tapa" d="M0 110C0 87.9086 17.9086 70 40 70H310C332.091 70 350 87.9086 350 110V110H0V110Z" fill="black"/>
                                <path class="tapa" d="M100 70C100 47.9086 117.909 30 140 30H210C232.091 30 250 47.9086 250 70V70H100V70Z" fill="black"/>
                                
                                <g class="cubo">
                                    <path  d="M25.7257 466.583L0 119H44L70.6987 456.504C71.3158 464.305 77.8264 470.321 85.6519 470.321H95.2566C103.826 470.321 110.653 463.155 110.239 454.596L94 119H152.375V455.321C152.375 463.605 159.091 470.321 167.375 470.321H175V499H60.6303C42.3025 499 27.0785 484.861 25.7257 466.583Z" fill="black"/>
                                    <path  d="M324.274 466.583L350 119H306L279.301 456.504C278.684 464.305 272.174 470.321 264.348 470.321H254.743C246.174 470.321 239.347 463.155 239.761 454.596L256 119H197.625V455.321C197.625 463.605 190.909 470.321 182.625 470.321H175V499H289.37C307.697 499 322.921 484.861 324.274 466.583Z" fill="black"/>
                        
                                </g>
                            </svg>
                            <br>
                            Borrar
                        </div>
                    </section>
                </div>
                <div class="elementComplete">
                    <section>
                        <p>ID: @{{editorial.idEditorial}}</p>
                        <p>Nombre: @{{editorial.nombre}}</p>
                    </section>
                </div>
            </section>
        </div>
        <section ng-show="mensajeModificar">
            <p><span>@{{mensajeModificar}}</span></p>
        </section>
        <div class="pieTabla">
            <div>Nombre de Editorial</div>
            <div>Aderrir</div>
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
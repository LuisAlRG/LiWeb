@extends('layouts.pant')

@section('titleAll','Lirbos')

@section('title')
	<title>LiWeb Libros</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloLibros.css">
@endsection
@section('subtitle')
	<p>Lirbos</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarLibro" method="post">
        <div id="claveSection">
        <label for="clave">Clave</label> 
        <input type="number" name="clave" id="clave"
            ng-model="clave"
        > 
        </div>
        <div id="edicionSection">
        <label for="edicion">Edicion</label>
        <input type="number" name="edicion" id="edicion"
            ng-model="edicion"
        > 
        </div>
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio"
            ng-model="precio"
        >
        <select name="categoria" id="categoria"
            ng-model="categoria"
        >
            <option value="1">Mayor al precio</option>
            <option value="2">Menor al precio</option>
        </select>

        <label for="tituloL">Titulo</label>
        <input type="text" name="tituloL" id="tituloL"
            ng-model="tituloL"
        >
        <label for="autorL">Autor</label>
        <input type="text" name="autorL" id="autorL"
            ng-model="autorL"
        >
        <label for="editorialL">Editorial</label>
        <input type="text" name="editorialL" id="editorialL"
            ng-model="editorialL"
        >
    </form>
</div>
@endsection
@section('botonesAccion')
<div id="botonesPrincipal">
    <div><button id="btnConsultar" >Consultar</button></div>
    <p>Navegar a:</p>
    <div> <a href="Libros/Autores"><button>Autores</button></a></div>
    <div> <a href="Libros/Generos"><button>Generos</button></a> </div>
    <div> <a href="Libros/Editoriales"> <button>Editoriales</button></a></div>
    <div> <a href="MenuPrincipal"><button>Menú</button></a> </div>
</div>
<div id="botonesFormMode">
    <div> <button id="btnFormAplicar"> Buscar </button> </div>
    <div> <button id="btnCancelarCons"> Cancelar </button> </div>
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Libro" class="fixingLibrosTop">
            <div class="cel1"> <span>#ID</span> </div>
            <div class="cel2"> <span>Titulo</span> </div>
            <div class="cel3"> <span>Autor</span> </div>
            <div class="cel4"> <span>Editorial</span> </div>
            <div class="cel5"> <span>Precio</span> </div>
            <div class="cel6"> <span>Accion</span> </div>
        </section>
        <div id="cuerpoEntero" class="fixingLibrosCuerpo">

            <section class="rowsElement_Libro">
            <div class="cel1"> <span>@{{libros.idLibro}}</span> </div>
            <div class="cel2"><span>@{{libros.titulo}}</span></div>
            <div class="cel3"><span>@{{FormatoDosAutores(libros.autores)}}</span></div>
            <div class="cel4"><span>@{{libros.editorial}}</span></div>
            <div class="cel5"><span>$@{{ (libros.precio).toLocaleString('en-US', {style: 'currency', currency: 'USD',}) }}</span></div>
            <div class="cel6">
                <svg viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#008000"/>
                    <rect x="58.4264" y="39.4558" width="15" height="50" rx="7.5" transform="rotate(45 58.4264 39.4558)" fill="black" fill-opacity="0.4"/>
                    <circle cx="66.9117" cy="41.5772" r="17.5" transform="rotate(45 66.9117 41.5772)" fill="black" fill-opacity="0.4"/>
                    <rect x="76.1041" y="20.364" width="17" height="19" transform="rotate(45 76.1041 20.364)" fill="#008000"/>
                    <rect x="55.4264" y="34.4558" width="15" height="50" rx="7.5" transform="rotate(45 55.4264 34.4558)" fill="white"/>
                    <circle cx="63.9117" cy="36.5772" r="17.5" transform="rotate(45 63.9117 36.5772)" fill="white"/>
                    <rect x="73.1041" y="15.364" width="17" height="19" transform="rotate(45 73.1041 15.364)" fill="#008000"/>
                </svg>
            </div>

                <div class="opcionesAdm">
                    <section>
                        <div>
                            <form action="Libro" method="post" id="goToModif@{{libros.idLibro}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                                <input type="hidden" name="thisLibroId" id="thisLibroId"
                                    value = @{{libros.idLibro}}
                                >
                            <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                                ng-click="OnModificarLibro(libros.idLibro)"
                            >
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
                            </form>
                            Modificar
                        </div>
                        <div>
                            <svg class="boteDeBasura" viewBox="-10 -10 380 510" fill="none" xmlns="http://www.w3.org/2000/svg"
                            ng-click="libros.selected=false; accionRemoverSeleccion($index)"
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
                        <div>
                            <p>Id: @{{libros.idLibro}}</p>
                            <p>Titulo: @{{libros.titulo}}</p>
                            <p>Precio: $ @{{libros.precio}} mx</p>
                            <p>Editorial: @{{libros.editorial}}</p>
                            <p>Cantidad en inventario: @{{libros.cantidad}}</p>
                        </div>
                        <div>
                            <p>Autores:</p>
                            <ul>
                                <li ng-repeat="autor in libros.autores"> @{{FormatoAutorNombre(autor)}}</li>
                            </ul>
                        </div>
                        
                        
                    </section>
                </div>
            </section>

        </div>
        <div class="pieTabla">
            <div>Titulo</div>
            <div>1ºAutor</div>
            <div>Editorial</div>
            <div>Genero</div>
            <div>Precio</div>
            <div>Aderir</div> <br>
            <form action="aderirLibro" id="aLibro">
                <div>
                    <input type="text" name="tituloLibroA" id="tituloLibroA"
                        ng-model="tituloLibroA"
                    >
                </div>
                <div>
                    <input type="text" list="autoresNamesFound" name="autorLibroA" id="autorLibroA"
                        ng-model="autorLibroA"
                    >
                    <datalist id="autoresNamesFound">
                        <option 
                            ng-repeat="autor in listBusqGenero"
                            value="@{{autor.nombre}}-@{{autor.apellido}}"
                        >clave: @{{autor.idAutor}} </option>
                    </datalist>
                </div>
                <div>
                    <input type="text" list="editorialesNamesFound" name="editorialLibroA" id="editorialLibroA"
                        ng-model="editorialLibroA"
                    >
                    <datalist id="editorialesNamesFound">
                        <option 
                            ng-repeat="editorial in listBusqEditorial"
                            value="@{{editorial.nombre}}"
                        >clave: @{{editorial.idEditorial}}</option>
                    </datalist>
                </div>
                <div>
                    <input type="text" list="generosNamesFound" name="generoLibroA" id="generoLibroA"
                        ng-model="generoLibroA"
                    >
                    <datalist id="generosNamesFound">
                        <option 
                            ng-repeat="genero in listBusqGenero"
                            value="@{{genero.nombre}}"
                        >clave: @{{genero.idGenero}}</option>
                    </datalist>
                </div>
                <div>
                    <input type="number" name="precioLibroA" id="precioLibroA"
                        ng-model="precioLibroA"
                    >
                </div>
                <div>
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
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
    </div>
    </div>
</tablaInfo>
@endsection
@section('script')
    <script src="/js/ClasesLocales/Libro.js"></script>
    <script src="/js/mainLibros.js"></script>
@endsection
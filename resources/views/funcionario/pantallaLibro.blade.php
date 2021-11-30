@extends('layouts.pant')

@section('titleAll','Lirbos')

@section('title')
	<title>LiWeb Libros</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloLibros.css">
@endsection
@section('subtitle')
    <p>Libros</p>
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
            ng-model="edicion" ng-disabled="DisableIfClave()"
        > 
        </div>
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio"
            ng-model="precio" ng-disabled="DisableIfClave()"
        >
        <select name="categoria" id="categoria"
            ng-model="categoria" ng-disabled="DisableIfClave()"
            ng-init="categoria = filtros[0]"
            ng-options="filtro.nombre for filtro in filtros"
        >
        </select>

        <label for="tituloL">Titulo</label>
        <input type="text" name="tituloL" id="tituloL"
            ng-model="tituloL" ng-disabled="DisableIfClave()"
        >
        <label for="autorL">Autor</label>
        <input type="text" name="autorL" id="autorL"
            ng-model="autorL" ng-disabled="DisableIfClave()"
        >
        <label for="editorialL">Editorial</label>
        <input type="text" name="editorialL" id="editorialL"
            ng-model="editorialL" ng-disabled="DisableIfClave()"
        >
        <label for="generoL">Genero</label>
        <input type="text" name="generoL" id="generoL"
            ng-model="generoL" ng-disabled="DisableIfClave()"
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
    <div> <button id="btnFormAplicar" ng-click="OnBuscarLibro()"> Buscar </button> </div>
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
            <form action="Libro" method="post" id="aLibro">
                
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
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                        ng-click="OnInsertarLibro()"
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
                <!--Elementos ocultos para ir a modificacion directa-->
                <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                <input type="hidden" name="thisLibroId" id="newLibroId">
                <!---->
            </form>
        </div>
    </div>
</tablaInfo>
@endsection
@section('script')
    <script src="/js/ClasesLocales/Libro.js"></script>
    <script src="/js/mainLibros.js"></script>
@endsection
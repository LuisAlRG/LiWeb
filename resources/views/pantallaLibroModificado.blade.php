@extends('layouts.pant')

@section('titleAll','Libro Modificable')

@section('title')
	<title>LiWeb Libro</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloLibrosMod.css">
@endsection
@section('subtitle')
    <p>Libros</p>
	<p>Modificar</p>
@endsection
@section('accinesInputs')
<div>
    <form action="noAccion" method="post">
        <label for="libroID">Clave</label> 
        <input type="number" name="libroID" id="libroID" value="{{$libro->idLibro}}" disabled>
        <label for="libroNombre">Nombre</label>
        <input type="text" name="libroNombre" id="libroNombre" value="{{$libro->titulo}}" disabled>
    </form>
</div>

@endsection
@section('botonesAccion')
<div>
    <p>Elementos aderidos</p>
    <div><button>Autor(es)</button></div>
    <div><button>Genero(s)</button></div>
    <div><button>Regresar a libro</button></div>
    <p>Navegar a:</p>
    <div> <a href="Libros"> <button>Regresar</button> </a> </div>
    <div> <a href="MenuPrincipal"> <button>Menu</button> </a> </div>
</div>
@endsection
@section('tables')
<detalleLibro>
    <section>
        <div>Modificar Libro</div>
    </section>
    
    <form action="Libro" method="post">
    <!--<input type="hidden" name="_token" value="{{ csrf_token() }} ">-->
    <div>
        <div>
            <label for="libroClaveM">Clave</label> 
            <input type="number" name="libroClaveM" id="libroClaveM" 
                value = "{{$libro->idLibro}}" disabled
            >
        </div>
        <div>
            <label for="libroTituloM">Titulo</label>
            <input type="text" name="libroTituloM" id="libroTituloM" 
                value = "{{$libro->titulo}}"
            >
        </div>
        <div>
            <label for="libroPrecioM">Precio</label>
            <input type="number" name="libroPrecioM" id="libroPrecioM"
                value = "{{$libro->precio}}"
            >
            <label for="libroEdicionM">No. Edicion</label>
            <input type="number" name="libroEdicionM" id="libroEdicionM"
               value = "{{$libro->edicion}}"
            >
            <label for="libroCantidadM">Cantidad</label>
            <input type="number" name="libroCantidadM" id="libroCantidadM"
                value = "{{$libro->cantidad}}"
            >
        </div>
        <div>
            <label for="claveEditorialM">Clave editorial</label>
            <input type="number" name="claveEditorialM" id="claveEditorialM"
                value = "{{$editorial->idEditorial}}"
                ng-model = "claveEditorialM"
                ng-init = "claveEditorialM = {{$editorial->idEditorial}}"
                ng-change = "OnDesplegarClaveEditorial($event,claveEditorialM)"
            >
            <label for="nombreEditorialM">Editorial (Nombre)</label>
            <input type="text" list="editorialNamesFound" name="nombreEditorialM" id="nombreEditorialM"
                value = "{{$editorial->nombre}}"
                ng-keyup = "OnBuscarEditorial('oNo',$event)"
            >
            <datalist id="editorialNamesFound">
                <option
                    ng-repeat="editorial in listBusqEditorial" 
                    value="@{{editorial.nombre}}"
                >
            </datalist>
        </div>
        <div ng-show="mensajeModificar">
            <p><span>@{{mensajeModificar}}</span></p>
        </div>
        <div>
            <button type="button" ng-click="OnModificarLibro()">Aplicar Modificacion</button>
        </div>
        <div ng-show="mensajeCorrecto">
            <p><span>@{{mensajeCorrecto}}</span></p>
        </div>
    </div>
    </form>
</detalleLibro>
<tbiAutor>
    <section>
        <div>Clave</div>
        <div>Nombre(s)</div>
        <div>Apellido(s)</div>
        <div>Actions</div>
    </section>
    <div class="cuerpoEntero">
        <section>
            <div>@{{autor.idAutor}}</div>
            <div>@{{autor.nombre}}</div>
            <div>@{{autor.apellido}}</div>
            <div>
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"
                    ng-click="OnQuitarAutor({{$libro->idLibro}},autor.idAutor,$index)"
                >
                    <circle cx="50" cy="50" r="45" fill="#008000"/>
                    <rect x="85" y="45" width="15" height="65" transform="rotate(90 85 45)" fill="black" fill-opacity="0.4"/>
                    <rect x="83" y="42" width="15" height="65" transform="rotate(90 83 42)" fill="white"/>
                </svg>
            </div>
            <section ng-show="mensajeQuitar">
                <p><span>@{{mensajeQuitar}}</span></p>
            </section>
            <div class="elementComplete">
                <section>
                    <p>ID: @{{autor.idAutor}}</p>
                    <p>Nombre: @{{autor.nombre}}</p>
                    <p>Apellido: @{{autor.apellido}}</p>
                </section>
            </div>
        </section>
    </div>
    <div class="pieTabla">
        <div>Buscar clave</div>
        <div>Nombre</div>
        <div>Apellido</div>
        <div>Aderrir</div>
        <form name="aderirAutorOnLibro" id="aderirAutorOnLibro" action="aderirAutorOnLibro" method="post">
            <div>
                <input type="number" name="idAutorB" id="idAutorB" 
                    ng-model="idAutorB"
                    ng-change="onDesplegarClaveAutor($event,idAutorB)"
                >
            </div>
            <div>
                <input type="text" list="autorNamesFound" name="nombreAutorB" id="nombreAutorB" required 
                    ng-model = "nombreAutorB"
                    ng-keyup= "onBuscarAutorNombre(nombreAutorB,$event)"
                >
                <datalist id="autorNamesFound" >
                    <option
                        ng-repeat="autor in listBusqAutor" 
                        value="@{{autor.nombre}}"
                        
                    > @{{autor.nombre}} @{{autor.apellido}} </option>
                </datalist>
            </div>
            <div>
                <input type="text" list="autorApellFound" name="apellidoAutorB" id="apellidoAutorB" required 
                    ng-model = "apellidoAutorB"
                    ng-keyup = "onBuscarAutorApellido(apellidoAutorB,$event)"
                >
                <datalist id="autorApellFound">
                    <option
                        ng-repeat="autor in listBusqAutor"
                        value="@{{autor.apellido}}"
                    > @{{autor.nombre}} @{{autor.apellido}}  </option>
                </datalist>
            </div>
            <div>
                <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                    ng-click="OnAderirAutor({{$libro->idLibro}})"
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
        <section ng-show="mensajeAdicion">
            <p><span>@{{mensajeAdicion}}</span></p>
        </section>
    </div>
</tbiAutor>
<tbiGeneros>
    <section>
        <div>Clave</div>
        <div>Nombre</div>
        <div>Actions</div>
    </section>
    <div class="cuerpoEntero">
        <section>
            <div>@{{genero.idGenero}}</div>
            <div>@{{genero.nombre}}</div>
            <div>
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"
                    ng-click="OnQuitarGenero({{$libro->idLibro}},genero.idGenero,$index)"
                >
                    <circle cx="50" cy="50" r="45" fill="#008000"/>
                    <rect x="85" y="45" width="15" height="65" transform="rotate(90 85 45)" fill="black" fill-opacity="0.4"/>
                    <rect x="83" y="42" width="15" height="65" transform="rotate(90 83 42)" fill="white"/>
                </svg>
            </div>
            <section ng-show="mensajeQuitar">
                <p><span>@{{mensajeQuitar}}</span></p>
            </section>
            <div class="elementComplete">
                <section>
                    <p>ID: @{{genero.idGenero}}</p>
                    <p>Nombre: @{{genero.nombre}}</p>
                </section>
            </div>
        </section>
    </div>
    <div class="pieTabla">
        <div>Buscar clave</div>
        <div>Genero</div>
        <div>Aderrir</div>
        <form name="aGeneroOnLibro" id="aGeneroOnLibro" action="aderirGeneroOnLibro">
            <input type="hidden" name="_token" value="{{ csrf_token() }} ">
            <div>
                <input type="number" name="idGeneroB" id="idGeneroB"
                    ng-model="idGeneroB"
                    ng-change="onDesplegarClaveGenero($event,idGeneroB)"
                >
            </div>
            <div>
                <input type="text" list="generoNamesFound" name="nombreGeneroB" id="nombreGeneroB" required 
                    ng-model = "nombreGeneroB"
                    ng-keyup = "onBuscarGenero(nombreGeneroB,$event)"
                >
                <datalist id="generoNamesFound">
                    <option
                        ng-repeat="genero in listBusqGenero" 
                        value="@{{genero.nombre}}"
                    >
                </datalist>
            </div>
            <div>
                <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                ng-click="OnAderirGenero({{$libro->idLibro}})"
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
        <section ng-show="mensajeAdicion">
            <p><span>@{{mensajeAdicion}}</span></p>
        </section>
    </div>
</tbiGeneros>
@endsection
@section('script')
<script src="/js/ClasesLocales/Autor.js"></script>
<script src="/js/ClasesLocales/Editorial.js"></script>
<script src="/js/ClasesLocales/Genero.js"></script>
<script src="/js/mainLibrosMod.js"></script>
@endsection
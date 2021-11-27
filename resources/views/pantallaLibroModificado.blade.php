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
<div>
    <form action="buscarAutorLib" method="post">
        <label for="autorClave">Clave Autor</label> 
        <input type="number" name="autorClave" id="autorClave"
            ng-model="autorClave" 
        >
        <label for="autorNombre">Nombre(s)</label>
        <input type="text" name="autorNombre" id="autorNombre"
            ng-model="autorNombre"
        > 
        <label for="autorApellido">Apellido(s)</label>
        <input type="text" name="autorApellido" id="autorApellido"
            ng-model="autorApellido"
        > 
    </form>
</div>
<div>
    <form action="buscarGeneroLib" method="post">
        <label for="generoClave">Clave Genero</label>
        <input type="number" name="generoClave" id="generoClave"
            ng-model="generoClave"
        >
        <label for="generoNombre">Nombre</label> 
        <input type="text" name="generoNombre" id="generoNombre"
            ng-model="generoNombre"
        > 
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
    <div> <button>Busqueda</button> </div> 
    <p>Elementos aderidos</p>
    <div><button>Autor(es)</button></div>
    <div><button>Genero(s)</button></div>
    <div><button>Regresar a libro</button></div>
    <p>Navegar a:</p>
    <div> <a href="../Libros"> <button>Regresar</button> </a> </div>
    <div> <a href="../MenuPrincipal"> <button>Menu</button> </a> </div>
</div>
@endsection
@section('tables')
<detalleLibro>
    <section>
        <div>Modificar Libro</div>
    </section>
    
    <form action="modificarLibro" method="post">
    <div>
        <div>
            <label for="libroClaveM">Clave</label> 
            <input type="number" name="libroClaveM" id="libroClaveM" 
                value = "{{$libro->idLibro}}"
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
            >
            <label for="nombreEditorialM">Editorial (Nombre)</label>
            <input type="text" name="nombreEditorialM" id="nombreEditorialM"
                value = "{{$editorial->nombre}}"
            >
        </div>
        <div>
            <button type="submit">Aplicar Modificacion</button>
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
            <div>@{{autor.id}}</div>
            <div>@{{autor.nombre}}</div>
            <div>@{{autor.apellido}}</div>
            <div>
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#008000"/>
                    <rect x="85" y="45" width="15" height="65" transform="rotate(90 85 45)" fill="black" fill-opacity="0.4"/>
                    <rect x="83" y="42" width="15" height="65" transform="rotate(90 83 42)" fill="white"/>
                </svg>
            </div>
            <div class="elementComplete">
                <section>
                    <p>ID: @{{autor.id}}</p>
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
                    ng-keyup="onDesplegarClaveAutor($event,idAutorB)"
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
                    ng-keyup="onBuscarAutorApellido(apellidoAutorB,$event)"
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
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" fill="#008000"/>
                    <rect x="85" y="45" width="15" height="65" transform="rotate(90 85 45)" fill="black" fill-opacity="0.4"/>
                    <rect x="83" y="42" width="15" height="65" transform="rotate(90 83 42)" fill="white"/>
                </svg>
            </div>
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
            <div>
                <input type="number" name="idGeneroB" id="idGeneroB">
            </div>
            <div>
                <input type="text" list="generoNamesFound" name="nombreGeneroB" id="nombreGeneroB" required 
                    ng-model = "nombreGeneroB"
                    ng-keyup="onBuscarGenero(nombreGeneroB,$event)"
                >
                <datalist id="generoNamesFound">
                    <option
                        ng-repeat="genero in listBusqGenero" 
                        value="@{{genero.nombre}}"
                    >
                </datalist>
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
</tbiGeneros>
@endsection
@section('script')
<script src="/js/ClasesLocales/Autor.js"></script>
<script src="/js/ClasesLocales/Editorial.js"></script>
<script src="/js/ClasesLocales/Genero.js"></script>
<script src="/js/mainLibrosMod.js"></script>
@endsection
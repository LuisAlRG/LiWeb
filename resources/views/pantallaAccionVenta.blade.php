@extends('layouts.pant')

@section('titleAll','Realizar Venta')

@section('title')
	<title>LiWeb Realizando Venta</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloLibros.css">
@endsection
@section('subtitle')
	<p>Venta</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarLibro" id="buscarLibro" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }} " id="tokenUsr1">
        <label for="clave">Clave del libro</label> 
        <input type="number" name="clave" id="clave"
            ng-model="clave" min=0 max=9000
        >
        <label for="tituloLibro">Titulo</label> <br>
        <input type="text" name="tituloLibro" id="tituloLibro"
            ng-model="tituloLibro" ng-disabled="DisableIfClave()"
        >
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio"
            ng-model="precio" ng-disabled="DisableIfClave()"
        >
        <select name="categoria" id="categoria"
            ng-model="categoria" ng-init="categoria = filtros[0]"
            ng-options="filtro.nombre for filtro in filtros"
            ng-disabled="DisableIfClave()"
        >
        </select>
    </form>

    <form action="Vender" id="realizarCompra" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }} " ng-model="tokenUsr2">
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" id="cliente" required
            ng-model="cliente"
        >
        <label for="responsable">Responsable</label>
        <input type="text" name="responsable" id="responsable"
            value="{{$responsable}}" disabled
        > 

        <input type="hidden" name="librosSelct" id="librosSelct"
            ng-model="librosSelct" 
        >
        <input type="hidden" name="librosCantidad" id="librosCantidad"
            ng-model="librosCantidad" 
        >
    </form>

</div>
@endsection
@section('botonesAccion')
<div>
    <div><button ng-click="OnBuscarLibro()">Buscar</button></div> 
    <div ng-click="QuitarEnLocalStorage()"> <a href="Venta"> <button >Cancelar</button></a></div>
</div>
@endsection
@section('tables')
<tablaInfo class="elementoDisponible">
    <form action="/LiWeb/Venta/VerTodoLibros" method="post"> 
    
    </form>
    <div>
        <section id="tableTop_Libro">
            <div class="cel1"> <span>#ID</span> </div>
            <div class="cel2"> <span>Titulo</span> </div>
            <div class="cel3"> <span>Autor</span> </div>
            <div class="cel4"> <span>Editorial</span> </div>
            <div class="cel5"> <span>Cantidad</span> </div>
            <div class="cel6"> <span>Aderir</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Libro"
            >
                <div class="cel1"> <span>@{{libros.idLibro}}</span> </div>
                <div class="cel2"><span>@{{libros.titulo}}</span></div>
                <div class="cel3"><span>@{{FormatoDosAutores(libros.autores)}}</span></div>
                <div class="cel4"><span>@{{libros.editorial}}</span></div>
                <div class="cel5"><span>@{{libros.cantidad}}</span></div>
                <div class="cel6">
                    
                    <svg  viewBox="-10 -10 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
                    ng-click="accionAderirSeleccion($index)"
                    ng-show="libros.idLibro > 0"
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
                
                <div class="elementComplete"
                >
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
        
    </div>
</tablaInfo>

<!-- Tabla de elementos seleccionados -->
<tablaInfo class="elementoSeleccionado">
    <div>
        <section id="tableTop_Libro">
            <div class="cel1" > <span>#ID</span> </div>
            <div class="cel2"> <span>Titulo</span> </div>
            <div class="cel3"> <span>Autor</span> </div>
            <div class="cel4"> <span>Editorial</span> </div>
            <div class="cel5"> <span>Precio</span> </div>
            <div class="cel6"> <span>Quitar</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Libro"
            >
                <div class="cel1"> <span>@{{libros.idLibro}}</span> </div>
                <div class="cel2"><span>@{{libros.titulo}}</span></div>
                <div class="cel3"><span>@{{FormatoDosAutores(libros.autores)}}</span></div>
                <div class="cel4"><span>@{{libros.editorial}}</span></div>
                <div class="cel5"><span>$@{{ (libros.precio).toLocaleString('en-US', {style: 'currency', currency: 'USD',}) }}</span></div>
                <div class="cel6">
                    <!-- <img src="img/basure.svg" alt="Bote de basura" ng-click="libros.selected=false; accionRemoverSeleccion($index)">-->
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
                </div>
                
                <div class="elementComplete"
                >
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
    </div>
</tablaInfo>

<!-- Precio y opcion de comprar -->
<especialVenta>
    <section>
        <span> Precio total: @{{ (precioTotal).toLocaleString('en-US', {style: 'currency', currency: 'USD',}) }} MX </span>
        <button  ng-click="AccionRealizarVenta()" ng-show="mostrarBtnVenta();"> Realizar venta </button>
    </section>
</especialVenta>
@endsection
@section('script')
    <script src="/js/ClasesLocales/Libro.js"></script>
    <script src="/js/mainActVenta.js"></script>
@endsection
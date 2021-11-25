@extends('layouts.pant')

@section('titleAll','Aplicar Venta')

@section('title')
	<title>LiWeb Vendiendo</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloLibrosVendidos.css">
@endsection
@section('subtitle')
	<p>Venta</p>
@endsection
@section('accinesInputs')
<form action="AplicarVenta" id="aplicarVenta" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }} " id="tokenUsr1">
    <input type="hidden" name="librosSelct" id="librosSelct"
        value="{{$librosSelct}}"
    >
    <input type="hidden" name="librosCantidad" id="librosCantidad"
        value="{{$librosCantidad}}"
    >
    <input type="hidden" name="cliente" id="cliente"
        value="{{$cliente}}"
    >
</form>
@endsection
@section('botonesAccion')
<div>
    <p>Metodo de pago:</p>
    <div><button>En efectivo</button></div>
    <div><button>Con tarjeta</button></div>
    <div><button>Con credito</button></div>
    <div><button>Otro Metodo</button></div> 
    <div> <a href="Menu"> <button>Cancelar</button></a> </div> 
    
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Libro">
            <div class="cel1"> <span>#ID</span> </div>
            <div class="cel2"> <span>Titulo</span> </div>
            <div class="cel3"> <span>Autor</span> </div>
            <div class="cel4"> <span>Editorial</span> </div>
            <div class="cel5"> <span>Precio</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Libro">
                <div class="cel1"><span>@{{libros.idLibro}}</span> </div>
                <div class="cel2"><span>@{{libros.titulo}}</span></div>
                <div class="cel3"><span>@{{FormatoDosAutores(libros.autores)}}</span></div>
                <div class="cel4"><span>@{{libros.editorial}}</span></div>
                <div class="cel5">
                    <span>$@{{getPrecioConFotmato(libros.precio)}} X @{{libros.cantidasSel}} 
                        = @{{getPrecioConFotmato(libros.precio * libros.cantidasSel)}}</span>
                </div>
                
                <div class="elementComplete">
                    <section>
                        <div>
                            <p>Id: @{{libros.idLibro}}</p>
                            <p>Titulo: @{{libros.titulo}}</p>
                            <p>Precio: @{{getPrecioConFotmato(libros.precio)}} </p>
                            <p>Editorial: @{{libros.editorial}}</p>
                            <p>Cantidad en inventario: @{{libros.cantidad}}</p>
                        </div>
                        <div>
                            <p>Autores:</p>
                            <ul>
                                <li> @{{FormatoAutorNombre(autor)}}</li>
                            </ul>
                        </div>

                    </section>
                </div>
            </section>
        </div>
    </div>
</tablaInfo>
<tablaPago>
    <section>
        <div class="cel1"> > </div>
        <div class="cel2"><span>Total:</span></div>
        <div class="cel3"><span> @{{getPrecioConFotmato(precioTotal)}}</span></div>
    </section>
</tablaPago>
<notaDePago>
    <section id="topPago">
        <div>Motivo</div>
        <div>Cantidad</div>
    </section>
    <section id="totalCobrar">
        <div>Total: </div>
        <div>@{{getPrecioConFotmato(precioTotal)}}</div>
        <div>IVA: </div>
        <div>@{{getPrecioConFotmato(precioTotal * 0.25)}}</div>
        <div>Total a cobrar: </div>
        <div>@{{getPrecioConFotmato(precioTotal + (precioTotal*0.25))}}</div>
    </section>
    <section id="totalPagar">
        <div>Cuanto pagara:</div>
        <div><input type="number" id="pago" name="pago" ng-model="pago"
            
            ng-change="OnDiferencia((precioTotal + (precioTotal*0.25)),pago)"
        ></div>
    </section>
    <section id="totalFeria">
        <div>Retorno:</div>
        <div>@{{getPrecioConFotmato(precioRetorno)}}</div>
    </section>
    <section id="aplicarVenta">
        <div>@{{" "}}</div>
        <div>
            <button ng-show="PermitirTerminar((precioTotal + (precioTotal*0.25)),pago)"
                ng-click="OnSubmit()"
            >
                Terminar
            </button>
        </div>
    </section>
</notaDePago>
@endsection
@section('script')
    <script src="/js/ClasesLocales/Libro.js"></script>
    <script src="/js/mainVentasPagos.js"></script>
@endsection
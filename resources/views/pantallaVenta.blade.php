@extends('layouts.pant')

@section('titleAll','Ventas')

@section('title')
	<title>LiWeb Ventas</title>
@endsection
@section('style')
	<link rel="stylesheet" href="/css/modeloVentas.css">
@endsection
@section('subtitle')
	<p>Venta</p>
@endsection
@section('accinesInputs')
<div>
    <form action="buscarVenta" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }} " ng-model="tokenUsr">
        <label for="clave">Clave de venta</label> 
        <input type="number" name="clave" id="claveID"
            ng-model="clave" min=0 max=9000
        > 
        <label for="fecha">Fecha</label> <br>
        <input type="date" name="fecha" id="fechaVal" 
            ng-model="fecha" ng-disabled="DisableIfClave()"
        >
        <select name="categoria" id="categoriaType"
            ng-model="categoria" ng-disabled="DisableIfClave()"
            ng-init="categoria = filtros[0]"
            ng-options="filtro.nombre for filtro in filtros "
        >
        <option value="exact">Exactamente la fecha</option>
        <option value="menor">Antes de fecha</option>
        <option value="mayor">Despues de la fecha</option>
        <option value="semana">Hace 7 dias</option>
        <option value="mes">Hace el mes</option>
        </select>
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" id="clienteName"
            ng-model="cliente" ng-disabled="DisableIfClave()"
        >
        <label for="responsable">Responsable</label>
        <input type="text" name="responsable" id="responsableName"
            ng-model="responsable" ng-disabled="DisableIfClave()"
        >
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
    <div>
        <button ng-click="OnBuscarVenta()" ng-show="showForm" >Buscar</button>
    </div> 
    <div>
        <a href="RealizarVenta">
        <button>Vender</button>
        </a>
    </div> 
    <div> 
        <button ng-click="showForm=true" ng-show="!showForm" >Consultar</button>
    </div> 
    <div>
        <button ng-click="showForm=false" ng-show="showForm" >Regresar</button>
    </div> 
    <div>
        <a href="MenuPrincipal">
        <button>Menu</button>
        </a>
    </div> 
</div>
@endsection
@section('tables')
<tablaInfo>
    <form action="/LiWeb/Venta/VerTodoVenta" method="post"> 
    <input type="hidden" name="tokenUsr2" value="{{ csrf_token() }} " ng-model="tokenUsr2">
    </form>
    <div>
        <section id="tableTop_Venta">
            <div class="cel1"> <span>#ID</span> </div>
            <div class="cel2"> <span>Cliente</span> </div>
            <div class="cel3"> <span>Responsable</span> </div>
            <div class="cel4"> <span>Fecha</span> </div>
            <div class="cel5"> <span>Vendidos</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="renglosElement_Venta">
                <div class="cel1"> <span>@{{venta.idVenta}}</span> </div>
                <div class="cel2"> <span>@{{FormatoCliente(venta.cliente)}}</span> </div>
                <div class="cel3"> <span>@{{FormatoNombre(venta.responsable)}}</span> </div>
                <div class="cel4"> <span>@{{FormatoFecha(venta.fechaHora)}}</span> </div>
                <div class="cel5"> <span>@{{getPrecioConFotmato(venta.vendidos)}}</span> </div>
                <div class="elementComplete">
                    <section>
                        <p>id: @{{venta.idVenta}}</p>
                        <p>Cliente: @{{FormatoCliente(venta.cliente)}}</p>
                        <p>Empleado: @{{venta.responsable}}</p>
                        <p>Fecha: @{{venta.fechaHora}}</p>
                        <p>Cantidad: @{{venta.vendidos}}</p>
                    </section>
                </div>
            </section>
        </div>
        
    </div>
</tablaInfo>
@endsection
@section('script')
    <script src="/js/mainVentas.js"></script>
@endsection
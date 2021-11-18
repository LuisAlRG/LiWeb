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

        <label for="clave">Clave de venta</label> 
        <input type="number" name="clave" id="claveID"
            ng-model="clave"
        > 
        <label for="fecha">Fecha</label> <br>
        <input type="date" name="fecha" id="fechaVal" 
            ng-model="fecha"
        >
        <select name="categoria" id="categoriaType"
            ng-model="categoria"
        >
        <option value="exact">Exactamente la fecha</option>
        <option value="menor">Antes de fecha</option>
        <option value="mayor">Despues de la fecha</option>
        <option value="semana">Hace 7 dias</option>
        <option value="mes">Hace el mes</option>
        </select>
        <label for="cliente">Cliente</label>
        <input type="text" name="cliente" id="clienteName"
            ng-model="cliente"
        >
        <label for="responsable">Responsable</label>
        <input type="text" name="responsable" id="responsableName"
            ng-model="responsable"
        >
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
<div>
    <div>
        <a href="PantallaVentaActiond.html">
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
        <a href="MenuPrincipal.html">
        <button>Menu</button>
        </a>
    </div> 
</div>
@endsection
@section('tables')
<tablaInfo>
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
                <div class="cel1"> <span>@{{venta.id}}</span> </div>
                <div class="cel2"> <span>@{{venta.cliente}}</span> </div>
                <div class="cel3"> <span>@{{venta.responsable}}</span> </div>
                <div class="cel4"> <span>@{{venta.fecha}}</span> </div>
                <div class="cel5"> <span>@{{venta.vendidos}}</span> </div>
                <div class="elementComplete">
                    <section>
                        <p>id: @{{venta.id}}</p>
                        <p>Cliente: @{{venta.cliente}}</p>
                        <p>Empleado: @{{venta.responsable}}</p>
                        <p>Fecha: @{{venta.fecha}}</p>
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
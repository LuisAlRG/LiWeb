@extends('layouts.pant')

@section('titleAll','Autores')

@section('title')
	<title>LiWeb Historial</title>
@endsection
@section('style')
    <link rel="stylesheet" href="/css/modeloHistorial.css">
@endsection
@section('subtitle')
    <p>Historial</p>
@endsection
@section('accinesInputs')
<div>
    <form action="accion" method="post">
        <label for="filtro">Tipo de Operacion</label>
        <select name="filtro" id="filtro"
            ng-model="filtro"
            ng-init="filtro = filtroOperaciones[0]"
            ng-options="operacion.nombre for operacion in filtroOperaciones"
        >
        </select>
        <label for="fechaMin">Fecha Minima</label>
        <input type="date" name="fechaMin" id="fechaMin"
            ng-model="fechaMin"
        >
        <label for="fechaMax">Fecha Maxima</label>
        <input type="date" name="fechaMax" id="fechaMax"
            ng-model="fechaMax"
        >
    </form>
</div>
@endsection
@section('botonesAccion')
<div>
    <div> <button ng-click="OnBuscarHistorial()">Buscar</button> </div>
    <div> <a href="MenuPrincipal"> <button>Menu</button></a></div> 
</div>
@endsection
@section('tables')
<tablaInfo>
    <div>
        <section id="tableTop_Historial">
            <div class="cel1"> <span>Descripcion</span> </div>
        </section>
        <div id="cuerpoEntero">
            <section class="rowsElement_Historial"
            >
                <div class="cel1">
                    <span>el @{{FormatoRol(historial.puestoEmp)}} 
                        @{{historial.nombreEmp}} 
                        @{{historial.operacion}} 
                        el dia @{{FormatoFecha(historial.fechaHora)}} </span>
                </div>
                
                <div class="elementComplete"
                >
                    <section>
                        <p>ID: @{{historial.id}}</p>
                        <p>ID del empleado : @{{historial.idEmpleado}}</p>
                        <p>Empleado: @{{historial.nombreEmp}}</p>
                        <p>Tipo de operacion: @{{historial.filtro}} </p>
                        <p>Fecha: @{{FormatoFecha(historial.fechaHora)}} </p>
                    </section>
                </div>
            </section>

        </div>
    </div>
</tablaInfo>
@endsection
@section('script')
<script src="/js/mainHistorial.js"></script>
@endsection
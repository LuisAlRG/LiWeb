var app = angular.module('allApp',[]);
var marcador = null;
const SECCION_ACTUAL = "/Historial"

$("tablaInfo>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"historial in listHistorial track by $index",
        'ng-init':"mostElemento=false"
    }
);



$("tablaInfo>div>div>section>div").attr(
    {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
);


$("tablaInfo>div>div>section>div.elementComplete").attr(
    {'ng-if':"mostElemento && indxSelecionado == $index"}
);


app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    $scope.listHistorial = [
        {id:0,
            idEmp:1,
            nombreEmp:"Sistema",
            puestoEmp:1,
            operacion:"esta cargando la lista",
            filtro:"Sistema",
            fecha:"21-10-21 g"
        }
    ];

    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/VerTodo",
        {}
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listHistorial = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listHistorial = [
                {id:-1,
                    idEmp:1,
                    nombreEmp:"Sistema",
                    puestoEmp:1,
                    operacion:"Avisando que uvo un error de peticion y recomienda volver mas tarde",
                    filtro:"Sistema",
                    fecha:"21-10-21 g"
                }
            ];
        }
    );

    $scope.indxSelecionado = 0;

    $scope.filtroOperaciones=[
        {nombre:"Todos", value:0},
        {nombre:"Venta", value:1},
        {nombre:"Libros", value:2},
        {nombre:"Empleados", value:3},
    ];

    //funciones de llamada
    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }

    //formatos
    $scope.FormatoFecha = function( laFecha ){
        if(laFecha != undefined){
            let cadena = (laFecha.split(' ')[0]).split('-');
            let fechaY = cadena[0],
                fechaM = cadena[1],
                fechaD = cadena[2]
            cadena = fechaD+'/'+fechaM+'/'+fechaY;
            return cadena;
        }
        return "-"
    }
    $scope.FormatoRol = function(rol){
        let cadena = "Error"
        switch(rol){
            case 1: cadena = "Funcionario"; break; //funcionario
            case 2: cadena = "Administrador"; break; //administrador
            case 3: cadena = "Gerente"; break; //gerente
        }
        return cadena;
    }
    //Eventos
    $scope.OnBuscarHistorial= function(){
        let enviar = {
            operacion:  $scope.filtro.value,
            fechaMin:   $scope.fechaMin,
            fechaMax:   $scope.fechaMax
        }
        console.log(enviar);
        if($scope.fechaMin!=undefined && $scope.fechaMax!=undefined){
            if($scope.fechaMin > $scope.fechaMax){
                console.log("minimo sobrepasa al maximo");
                $scope.MensajeBusqueda = "Las fechas estan desordenadas (el minimo sobrepasa al maximo)" ;
                return true;
            }
        }
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Consultar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos)
                    if(datos[0]){
                        $scope.listHistorial = datos;
                        return 1;
                    }
                $scope.listHistorial = [
                    {id:0,
                        idEmp:1,
                        nombreEmp:"Sistema",
                        puestoEmp:1,
                        operacion:"Avisando que no hay historial de usted",
                        filtro:"Sistema",
                        fecha:"21-10-21 g"
                    }
                ];
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.listHistorial = [
                    {id:-1,
                        idEmp:1,
                        nombreEmp:"Sistema",
                        puestoEmp:1,
                        operacion:"Avisando que uvo un error de peticion y recomienda volver mas tarde",
                        filtro:"Sistema",
                        fecha:"21-10-21 g"
                    }
                ];
            }
        );
    }
});
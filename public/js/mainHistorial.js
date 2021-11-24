var app = angular.module('allApp',[]);
var marcador = null;

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
            nombreEmp:"Luisito",
            puestoEmp:"Funcionario",
            operacion:"Realiso una venta",
            filtro:"Ventas",
            fecha:"21/10/21"
        },
        {id:1,
            idEmp:2,
            nombreEmp:"Jose",
            puestoEmp:"Gerente",
            operacion:"Agrego un nuevo libro",
            filtro:"Libros",
            fecha:"25/10/21"
        },
        {id:2,
            idEmp:3,
            nombreEmp:"Kenji",
            puestoEmp:"Administrador",
            operacion:"fue dado en alto",
            filtro:"Empleados",
            fecha:"31/10/21"
        }
    ]
    for(let i=3;i<8;i++){
        
        $scope.listHistorial.push(
            {id:i,
                idEmp:i+2,
                nombreEmp:"Pepe",
                puestoEmp:"Funcionario",
                operacion:"Realizo una venta",
                filtro:"Ventas",
                fecha:"31/10/21"
            }
        );
    }

    $scope.indxSelecionado = 0;
    //funciones de llamada


    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }

});
var app = angular.module('allApp',[]);
var marcador = null;

    $("#parteIzquierdo").attr(
        {
            'ng-init':"showForm = false"
        }
    );

    $("#parteIzquierdo>accionesInputs").attr(
        {
            'ng-if':"showForm"
        }
    );

    $("tablaInfo>div>div>section").attr(
        {
            'ng-repeat':"venta in listVenta track by $index",
            'ng-init':"mostElemento = false;"
        }
    );

    $("tablaInfo>div>div>section>div").attr(
        {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
    );

    $("tablaInfo>div>div>section>div.elementComplete").attr(
        {'ng-if':"mostElemento && indxSelecionado == $index"}
    );

    app.controller('allController',function($scope,$http){
        //inicializaciones
        $scope.listVenta=[
            {id:0,cliente:"Cargando",responsable:"Falcones",fecha:"11/03/2021",vendidos:64},
        ];
    
        $scope.listVentaMostrado=[];

        $scope.indxSelecionado = 0;


        //peticion de entrada
        $http.post(DIRECCION_HTTPS+"/Venta/VerTodoVenta",
            {
                _token:$scope.tokenUsr2
            }
        ).then(
            function(rensopne){
                let datos = rensopne.data;
                console.log(datos);
                $scope.listVenta = datos;
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.listVenta=[
                    {id:-1,cliente:"No se pudo cargar",responsable:"Falcones",fecha:"11/03/2021",vendidos:64},
                ];
            }
        );

        //funciones
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

        $scope.FormatoNombre = function(nombreCompleto){
            let nombre = nombreCompleto.split('-')[0];
            return nombre;
        }

        $scope.FormatoCliente = function(texto){
            if(isEmptyOrSpaces(texto)){
                texto = "(N/A)";
            }
            return texto;
        }

        $scope.setIndxSelecionado = function(elIndex){
            $scope.indxSelecionado = elIndex;
        }

        $scope.getPrecioConFotmato= function(precio){
            return (precio).toLocaleString('en-US', {style: 'currency', currency: 'USD',})
        }

        $scope.cambiarSelectedIndex = function(elIndex){
            return $scope.indxSelecionado == elIndex;
        }
    });

//funcion para saver si esta vacio o null
//sacado de https://stackoverflow.com/questions/10232366/how-to-check-if-a-variable-is-null-or-empty-string-or-all-whitespace-in-javascri
function isEmptyOrSpaces(str){
    return str === null || str.match(/^ *$/) !== null;
}
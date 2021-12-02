var app = angular.module('allApp',[]);
var marcador = null;

$("tablaInfo>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"libros in listLibrosSelect track by $index",
        'ng-init':"mostElemento=false"
    }
);

$("tablaInfo>div>#cuerpoEntero>section>div").attr(
    {
        'ng-click':"mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"
    }
);

$("tablaInfo>div>#cuerpoEntero>section>div.cel5 , div.elementComplete").attr(
    {
        'ng-click':""
    }
);

$("div.elementComplete").attr(
    {
        'ng-if':"mostElemento && indxSelecionado == $index"
    }
);

$("div.elementComplete>section>div>ul>li").attr(
    {
        'ng-repeat':"autor in libros.autores"
    }
);

//desaparese la tabla de elementos y aparese el nota de pago
$("tablaInfo, tablaPago").attr(
    {
        'ng-if':"banderaCaso==0"
    }
);
$("notaDePago").attr(
    {
        'ng-if':"banderaCaso>0"
    }
);
$("botonesDeAccion>div>div>button").attr(
    { 
        'ng-show':"banderaCaso==0"
    }
);
$("botonesDeAccion>div>div:nth-child(2)>button").attr(
    {
        'ng-click':"banderaCaso=1"
    }
);
$("botonesDeAccion>div>div:nth-child(3)>button").attr(
    {
        'ng-click':"banderaCaso=2"
    }
);
$("botonesDeAccion>div>div:nth-child(4)>button").attr(
    {
        'ng-click':"banderaCaso=3"
    }
);
$("botonesDeAccion>div>div:nth-child(5)>button").attr(
    {
        'ng-show':"banderaCaso!=0",
        'ng-click':"banderaCaso=0"
        
    }
);

app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    $scope.precioTotal = 0;

    $scope.indxSelecionado = 0;

    $scope.banderaCaso = 0;
    $scope.precioRetorno = 0;
    //inicializando valores
    $scope.listLibros = [
        new Libro(0,1,//id libro id editorial
            "Cargando",//titulo
            440,//precio
            1,//edicion
            1//cantidad
        )
    ]
    //$scope.apply();
    console.log($("#tokenUsr1").val()); 
    console.log($("#librosSelct").val()); 
    console.log($("#librosCantidad").val()); 

    $http.post(DIRECCION_HTTPS+"/Vender/LibrosSeleccionados",
        {
            _token: $("#tokenUsr1").val(),
            librosSelct: $("#librosSelct").val(),
            librosCantidad: $("#librosCantidad").val()
        }
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listLibros = datos;
            $scope.listLibrosSelect = $scope.listLibros;
            totalPrecio();
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listVenta=[
                new Libro(-1,1,//id libro id editorial
                "Hoy no es un buen dia para venta",//titulo
                440,//precio
                1,//edicion
                1//cantidad
            )];
        }
    );

    $scope.listLibrosSelect = $scope.listLibros;


    //formatos
    $scope.FormatoDosAutores = function(autores){
        let tresAutores = autores.slice(0,3);
        let cadena = [];
        tresAutores.forEach(autor => {
            cadena.push(autor.nombre+" "+autor.apellido);
        });
        return cadena.join(", ");
    }
    $scope.FormatoAutorNombre = function(autor){
        let cadena = "";
        cadena += isEmptyOrSpaces(autor.nombre)?"":autor.nombre;
        cadena += isEmptyOrSpaces(autor.apellido)?"":autor.apellido;
        return cadena;
    }
    //funciones de uso
    function totalPrecio() { 
        $scope.precioTotal = 0;
        $scope.listLibros.forEach(element => {
            $scope.precioTotal += element.precio * element.cantidasSel;
        });
    }
    
    //funciones de llamada
    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }
    $scope.getPrecioConFotmato= function(precio){
        return (precio).toLocaleString('en-US', {style: 'currency', currency: 'USD',})
    }
    $scope.QuitarEnLocalStorage = function(){
        localStorage.setItem("guardado",false);
    }
    
    $scope.OnDiferencia = function(precioTotal,precipPagado){
        $scope.precioRetorno = precipPagado - precioTotal;
    }
    $scope.PermitirTerminar = function(precioTotal,precipPagado){
        return (precipPagado - precioTotal) >= 0;
    }

    $scope.OnSubmit = function(){
        let nombreid = "aplicarVenta";
        document.getElementById(nombreid).submit();
    }
});

//funcion para saver si esta vacio o null
//sacado de https://stackoverflow.com/questions/10232366/how-to-check-if-a-variable-is-null-or-empty-string-or-all-whitespace-in-javascri
function isEmptyOrSpaces(str){
    return str === null || str.match(/^ *$/) !== null;
}
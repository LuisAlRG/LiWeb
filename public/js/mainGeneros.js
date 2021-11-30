var app = angular.module('allApp',[]);
var marcador = null;
const SECCION_ACTUAL = "/Libros/Generos";
const ESPACIO_BACIO = "Escriba algo para considerarse como \"Generp\"";

$("tablaInfo>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"genero in listGenero track by $index",
        'ng-init':"mostElemento=false"
    }
);

$("tablaInfo>div>div>section>div").attr(
    {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
);

$("tablaInfo>div>div>section>div.cel3").attr(
    {'ng-click': ""}
);
$("div.cel3>svg").attr(
    {'ng-click':"mostOpcionesAdm= ((mostOpcionesAdm && (indxSelecionadoOp == $index)) ? false : true); setIndxSelecionadoOp($index)"}
);

$("tablaInfo>div>div>section>div.elementComplete").attr(
    {'ng-if':"mostElemento && indxSelecionado == $index"}
);

$("tablaInfo>div>div>section>div.opcionesAdm").attr(
    {'ng-if':"mostOpcionesAdm && indxSelecionadoOp == $index"}
);

$("tablaInfo>div>div>section>div.mensageSections").attr(
    {'ng-if':"mostOpcionesAdm && indxSelecionadoOp == $index"}
);

$("div.opcionesAdm>section>div:nth-child(1)>svg").attr(
    {'ng-click':"OnModificarGenero(genero,$index)"}
)
app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    $scope.listGenero = [
        new Genero(0,"Cargando")
    ];
    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/VerTodos",
        {}
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listGenero = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listGenero=[
                new Genero(-1,"No se a podido cargar. Intente de nuevo mas tarde")
            ];
        }
    );

    $scope.indxSelecionado = 0;
    $scope.indxSelecionadoOp = 0;
    //funciones de llamada


    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
        $scope.mensajeInsertar = null;
        $scope.mensajeModificar = null;
        $scope.mensajeBorrar = null;
    }
    $scope.setIndxSelecionadoOp = function(elIndex){
        $scope.indxSelecionadoOp = elIndex;
        $scope.mensajeInsertar = null;
        $scope.mensajeModificar = null;
        $scope.mensajeBorrar = null;
    }

    $scope.MostrarSiMensage = function(){
        return $scope.mensajeInsertar || 
            $scope.mensajeModificar ||
            $scope.mensajeBorrar;
    }

    $scope.DisableIfClave = function(){
        if($scope.clave === undefined)
            return false;
        return $scope.clave >0;
    }

    //Eventos
    $scope.OnInsertarGenero = function(){
        let enviar = {
            nombre: $scope.nombreGeneroA
        }
        if( isEmptyOrSpaces(enviar.nombre) ){
            $scope.mensajeInsertar = ESPACIO_BACIO;
            return true;
        }
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Insertar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == "re"){
                    $scope.mensajeInsertar = "Genero ya ingresado. Tiene que tener alguna diferencia";
                    return true;
                }
                $scope.listGenero.push(datos);
                $scope.nombreGeneroA = "";
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.mensajeInsertar = ERROR_PETICION;
            }
        );
    }

    $scope.OnBuscarGenero = function(){
        let enviar = {
            clave:      $scope.clave,
            nombre:     $scope.nombre
        }
        console.log(enviar);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Consultar",
            enviar
        ).then(
            function (response) {
                let datos = response.data;
                console.log(datos);
                if(datos)
                    if(datos[0]){
                        $scope.listGenero = datos;
                        return 1;
                    }
                $scope.listGenero=[
                    new Genero(0,"No hay generos con esta descripciones")
                ];
            },
            function (response) {
                let datos = response.data;
                console.log(datos);
                $scope.listGenero=[
                    new Genero(-1,"No se a podido cargar. Intente de nuevo mas tarde")
                ];
            }
        );
    }

    $scope.OnEliminarGenero = function(idGenero,indexLista){
        let enviar = {
            clave: idGenero
        }
        console.log(enviar);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Borrar",
            enviar
        ).then(
            function (response) {
                let datos = response.data;
                console.log(datos);
                if(datos == "no"){
                    $scope.mensajeBorrar = "El genero tiene libros relacionados, no se puede borrar sin borrar esos libros antes"
                    return true;
                }
                $scope.listGenero.splice(indexLista,1);
            },
            function (response) {
                let datos = response.data;
                console.log(datos);
                $scope.mensajeBorrar = ERROR_PETICION;
            }
        );
    }

    $scope.OnModificarGenero = function(genero,thisindex){
        console.log(genero);
        let claseElemento = ".element"+genero.idGenero;
        console.log(claseElemento);
        $scope.indxSelecionadoOp = -1;
        $scope.indxSelecionado = -1;
        let
        columna1='<div class="cel1 Quitable">'+'<input type="number" name="claveM" id="claveM" value='+genero.idGenero+' disabled>'+'</div>',
        columna2='<div class="cel2 Quitable">'+'<input type="text" name="nombreGenerosM" id="nombreGenerosM" value="'+genero.nombre+'">'+'</div>',
        columna3='<div class="cel3 Quitable">'+
        '<svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" ng-click="">'+
        '<rect id="Rectangle 1" width="100" height="100" fill="white"/>'+
        '<circle id="fondo" cx="50" cy="50" r="45" fill="#008000"/>'+
        '<g id="Sombra">'+
        '<path id="Vector 1" d="M87.25 39.75L41.25 86.25L13.75 58.25L24.25 47.75L41.25 64.25L76.75 28.75L87.25 39.75Z" fill="black" fill-opacity="0.4"/>'+
        '</g>'+
        '<g id="ElementoClave">'+
        '<rect id="Rectangle 2" x="75.9325" y="23.9706" width="15" height="65" transform="rotate(45 75.9325 23.9706)" fill="white"/>'+
        '<rect id="Rectangle 3" x="51.1838" y="69.9325" width="15" height="39" transform="rotate(135 51.1838 69.9325)" fill="white"/>'+
        '</g>'+
        '</svg>'+
        '</div>';
        $(claseElemento + ">div").toggleClass("putItInvisible");
        $(claseElemento).append(
            columna1+
            columna2+
            columna3
        );
        $(claseElemento+">div.Quitable svg").click(function(){
            let enviar = {
                clave:  parseInt($("#claveM").val()),
                nombre:  $("#nombreGenerosM").val()
            }
            console.log(enviar);
            if( isEmptyOrSpaces(enviar.nombre) ){
                $scope.mensajeModificar = ESPACIO_BACIO;
                return true;
            }
            $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Modificar",
                enviar
            ).then(
                function(response) {
                    let datos = response.data;
                    console.log(datos);
                    if(datos == "re"){
                        $scope.mensajeModificar = "Nombre repetido, intente con otro";
                        return true;
                    }
                    $(".Quitable").remove();
                    $scope.listGenero[thisindex].nombre= enviar.nombre;
                    $(claseElemento + ">div").toggleClass("putItInvisible");
                    //$scope.$apply();
                    $scope.mensajeModificar = null;
                },
                function(response) {
                    let datos = response.data;
                    console.log(datos);
                    $scope.mensajeModificar = ERROR_PETICION;
                }
            );
            /*
            $(".Quitable").remove();
            $scope.listGenero[thisindex].idEditorial= enviar.clave;
            $scope.listGenero[thisindex].nombre= enviar.nombre;
            $(claseElemento + ">div").toggleClass("putItInvisible");
            $scope.$apply();
            */
        });
    }
});
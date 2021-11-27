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

    $("#parteIzquierdo>botonesDeAccion>div#botonesPrincipal").attr(
        {
            'ng-show':"!showForm"
        }
    );

    $("#parteIzquierdo>botonesDeAccion>div#botonesFormMode").attr(
        {
            'ng-show':"showForm"
        }
    );

    $("#btnConsultar").attr(
        {
            'ng-click':"showForm = true"
        }
    );

    $("#btnCancelarCons").attr(
        {
            'ng-click':"showForm = false"
        }
    );

    $("tablaInfo>div>div#cuerpoEntero>section").attr(
        {
            'ng-repeat':"libros in listLibros track by $index",
            'ng-init':"mostElemento = false; mostOpcionesAdm = false;"
        }
    );

    $("tablaInfo>div>div#cuerpoEntero>section>div").attr(
        {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index)"}
    );

    $("div.cel6").attr(
        {'ng-click': ""}
    );

    $("div.cel6>svg").attr(
        {'ng-click':"mostOpcionesAdm= ((mostOpcionesAdm && (indxSelecionadoOp == $index)) ? false : true); setIndxSelecionadoOp($index) "}
    );

    $("tablaInfo>div>div>section>div.elementComplete").attr(
        {'ng-if':"mostElemento && indxSelecionado == $index"}
    );

    $("tablaInfo>div>div>section>div.opcionesAdm").attr(
        {'ng-if':"mostOpcionesAdm && indxSelecionadoOp == $index"}
    );

//Botones de submit
    $(".aderirLibro>svg").attr(
        {'ng-click':"submitAderir()"}
    );

app.controller('allController',function($scope,$http){
    //inicializaciones

    let primerElemento = new Libro(0,1,//id libro id editorial
        "Cargando",//titulo
        440,//precio
        1,//edicion
        1//cantidad
    );
    $scope.listLibros=[
        primerElemento
    ];

    $http.post(DIRECCION_HTTPS+"/Libros/VerTodoLibros",
        {
            _token:$scope.tokenUsr2
        }
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listLibros = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listLibros=[
                new Libro(-1,1,//id libro id editorial
                "No se a podido Cargar, intente de nuevo mas tarde",//titulo
                440,//precio
                1,//edicion
                1//cantidad
            )];
        }
    );

    $scope.listVentaMostrado=[];

    $scope.indxSelecionado = 0;
    $scope.indxSelecionadoOp = 0;

    $scope.filtros=[
        {nombre:"Mayor al precio", value:1},
        {nombre:"Menor al precio", value:2}
    ];

    $scope.listMostAutores=[
        {
            nombre:"No Cargados"
        }
    ];

    $scope.listMostEditorial=[
        {
            nombre:"No cargado"
        },
    ];


    //Formatos
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

    //funciones
    

    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }
    $scope.setIndxSelecionadoOp = function(elIndex){
        $scope.indxSelecionadoOp = elIndex;
    }


    $scope.cambiarSelectedIndex = function(elIndex){
        return $scope.indxSelecionado == elIndex;
    }

    //efecto de botones
    $scope.submitAderir = function(){
        let inParm ={
            titulo: $scope.instTexto,
            autor:  $scope.autorIn,
            editorial:  $scope.editorialIn,
            precio: $scope.instPrecio
        }
        console.log(inParm);
    }

    $scope.OnModificar=function(numeroId){
        console.log("si paso");
        let nombreid = "goToModif" + numeroId;
        document.getElementById(nombreid).submit();
    }
});

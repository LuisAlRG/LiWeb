var app = angular.module('allApp',[]);
var marcador = null;
var marcador = null;
const SECCION_ACTUAL = "/Libros"

$("#parteIzquierdo").attr(
    {
        'ng-init':"showForm = false"
    }
);

$("#parteIzquierdo>accionesInputs").attr(
    {
        'ng-show':"showForm"
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

    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/VerTodoLibros",
        {}
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
        let tresAutores = autores?.slice(0,3);
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


    $scope.cambiarSelectedIndex = function(elIndex){
        return $scope.indxSelecionado == elIndex;
    }

    $scope.DisableIfClave = function(){
        if($scope.clave === undefined)
            return false;
        return $scope.clave >0;
    }

    //Eventos
    $scope.OnInsertarLibro = function(){
        $scope.setIndxSelecionado(0);
        $scope.setIndxSelecionadoOp(0);
        let enviar ={
            titulo:     $scope.tituloLibroA,
            autor:      $scope.autorLibroA,
            editorial:  $scope.editorialLibroA,
            genero:     $scope.generoLibroA,
            precio:     $scope.precioLibroA
        }
        console.log(enviar);
        $scope.mensajeInsertar = "";
        if(isEmptyOrSpaces(enviar.titulo)){
            $scope.mensajeInsertar += "Titulo Vacio \n";
        }
        if(isEmptyOrSpaces(enviar.autor)){
            $scope.mensajeInsertar += "Autor Vacio \n";
        }
        if(isEmptyOrSpaces(enviar.editorial)){
            $scope.mensajeInsertar += "Editorial Vacio \n";
        }
        if(isEmptyOrSpaces(enviar.genero)){
            $scope.mensajeInsertar += "Genero Vacio \n";
        }
        if(enviar.precio === undefined){
            $scope.mensajeInsertar += "Precio Vacio \n";
        }
        else{
            if(enviar.precio<0)
                $scope.mensajeInsertar += "Precio Es negativo \n";
        }
        //revisar si no hay errores
        if(!isEmptyOrSpaces($scope.mensajeInsertar)){
            $scope.mensajeInsertar = "No se puede modificar libro por los siguiente(s) problema(s): \n"+
                $scope.mensajeInsertar;
            return true;
        }
        //pasando la verificacion
        $scope.mensajeModifica=null;
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Insertar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == "re"){
                    $scope.mensajeInsertar = "Editorial ya ingresado. Tiene que tener alguna diferencia";
                    return true;
                }
                $scope.listLibros.push(datos);
                $scope.instTexto = undefined;
                $scope.autorIn = undefined;
                $scope.editorialIn = undefined;
                $scope.generoLibroA = undefined;
                $scope.instPrecio = 0;
                $("#newLibroId").val(datos.idLibro);
                $("#aLibro").submit();
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.mensajeInsertar = ERROR_PETICION;
            }
        );
    }

    $scope.OnBuscarLibro = function(){
        $scope.setIndxSelecionado(0);
        $scope.setIndxSelecionadoOp(0);
        let enviar = {
            clave:      $scope.clave,
            edicion:    $scope.edicion,
            precio:     $scope.precio,
            categoria:  $scope.categoria.value,
            titulo:     $scope.tituloL,
            autor:      $scope.autorL,
            editorial:  $scope.editorialL,
            genero:     $scope.generoL
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
                        $scope.listLibros = datos;
                        return 1;
                    }
                $scope.listLibros=[
                    new Libro(0,1,//id libro id editorial
                    "No hay libros con esta descripciones",//titulo
                    440,//precio
                    1,//edicion
                    1//cantidad
                )];
            },
            function (response) {
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
    }

    $scope.OnEliminarLibro = function(idLibro,indexLista){
        $scope.setIndxSelecionado(0);
        let enviar = {
            clave:  idLibro
        };
        console.log(enviar);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Borrar",
            enviar
        ).then(
            function (response) {
                let datos = response.data;
                console.log(datos);
                if(datos == "no"){
                    $scope.mensajeBorrar = "Este libro ya tiene trnasacciones de ventas, no se podria borrar bajo ninguna sircunstancias"
                    return true;
                }
                $scope.listLibros.splice(indexLista,1);
            },
            function (response) {
                let datos = response.data;
                console.log(datos);
                $scope.mensajeBorrar = ERROR_PETICION;
            }
        );
    }

    $scope.OnModificarLibro=function(numeroId){
        $scope.setIndxSelecionado(0);
        console.log("si paso");
        let nombreid = "goToModif" + numeroId;
        console.log($("#thisLibroId").val());
        document.getElementById(nombreid).submit();
    }
});

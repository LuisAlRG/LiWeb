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

        let primerElemento = new Libro(1,2,//id libro id editorial
            "El Poopero",//titulo
            320,//precio
            5,//edicion
            5//cantidad
        );
        primerElemento.addListAutor = ["chayanne","Ilum Ticks","uno mas","otro mas", "Nunca acabara"];
        primerElemento.setEditorial = "Nulle Illuminatus";
        $scope.listLibros=[
            primerElemento
        ];

        for(let i=1;i<15;i++){
            let generarTitulo = "Programacion " + ((i%8==0)?"Estrcuturada":(i%6==0)?"Logica":(i%4==0)?"Para principiantes":(i%2==0)?"de C# y javascript":"para Proyectos");
            let precioGenerado = Math.random()* (5001 - 200) + 200;

            let objetoLibro = new Libro(i,i%8,
                generarTitulo,
                precioGenerado,
                i%9,
                10 + (i*(i%6))
            )
            objetoLibro.addListAutor = ["Luisito Rodriguez","Fransisco Imadero"];
            objetoLibro.setEditorial = (i%2==0)?"Sumerville":"Prentice Hall";
            $scope.listLibros.push(
                objetoLibro
            );
        }
    
        $scope.listVentaMostrado=[];

        $scope.indxSelecionado = 0;
        $scope.indxSelecionadoOp = 0;

        $scope.listMostAutores=[
            {
                nombre:"Rodriguez G. Luisito"
            },
            {
                nombre:"Camilo Fernando"
            },
            {
                nombre:"Bruegge"
            },
            {
                nombre:"Stuart Russell"
            }
        ];

        $scope.listMostEditorial=[
            {
                nombre:"PERSON: Prentice Hall"
            },
            {
                nombre:"Macornigui"
            },
            {
                nombre:"Editoriales Illuminatus"
            },
            {
                nombre:"McGrawHill"
            }
        ];

        //funciones
        $scope.formatoFecha = function( laFecha ){
            let cdena = venta.fecha.getDate() +"/"+ venta.fecha.getMonth() +"/"+ venta.fecha.getFullYear() ;
            return cdena;
        }

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
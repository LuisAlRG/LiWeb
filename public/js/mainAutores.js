var app = angular.module('allApp',[]);
var marcador = null;

$("tablaInfo>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"autor in listAutores track by $index",
        'ng-init':"mostElemento=false; mostOpcionesAdm = false;"
    }
);

$("tablaInfo>div>div>section>div").attr(
    {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
);

$("tablaInfo>div>div>section>div.cel4").attr(
    {'ng-click': ""}
);
$("div.cel4>svg").attr(
    {'ng-click':"mostOpcionesAdm= ((mostOpcionesAdm && (indxSelecionadoOp == $index)) ? false : true); setIndxSelecionadoOp($index) "}
);

$("tablaInfo>div>div>section>div.elementComplete").attr(
    {'ng-if':"mostElemento && indxSelecionado == $index"}
);

$("tablaInfo>div>div>section>div.opcionesAdm").attr(
    {'ng-if':"mostOpcionesAdm && indxSelecionadoOp == $index"}
);

$("div.opcionesAdm>section>div:nth-child(1)>svg").attr(
    {'ng-click':"OnModificarAutor(autor,$index)"}
);

app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    $scope.listAutores = [
        new Autor(0,"Herman","Cortes")
    ]
    for(let i=1;i<15;i++){
        let numeroAletorio = parseInt(Math.random() * 100);
        let generarNombre1= ((numeroAletorio%8==0)?"Luis":(numeroAletorio%6==0)?"Fernando":(numeroAletorio%4==0)?"Memo":(numeroAletorio%2==0)?"Pedro":"Jose");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarNombre2= ((numeroAletorio%8==0)?"de la Casa":(numeroAletorio%6==0)?"Carmino":(numeroAletorio%4==0)?"Gillermo":(numeroAletorio%2==0)?"Kristino":"");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarApellido1= ((numeroAletorio%8==0)?"Rodriguez":(numeroAletorio%6==0)?"Gonzalez":(numeroAletorio%4==0)?"Manriquez":(numeroAletorio%2==0)?"Berzunsa":"");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarApellido2= ((numeroAletorio%8==0)?"Gonzalez":(numeroAletorio%6==0)?"Aguilar":(numeroAletorio%4==0)?"Zapata":(numeroAletorio%2==0)?"":"Jonstar");
        $scope.listAutores.push(
            new Autor(
                i,
                generarNombre1+" "+generarNombre2,
                generarApellido1+" "+generarApellido2
            )
        );
    }

    $scope.indxSelecionado = 0;
    $scope.indxSelecionadoOp = 0;
    //funciones de llamada


    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }
    $scope.setIndxSelecionadoOp = function(elIndex){
        $scope.indxSelecionadoOp = elIndex;
    }

    
    $scope.OnModificarAutor = function(autor, thisindex){
        console.log(autor);
        let claseElemento = ".element"+autor.idAutor
        console.log(claseElemento);
        $scope.indxSelecionadoOp = -1;
        $scope.indxSelecionado = -1;
        let 
        columna1='<div class="cel1 Quitable"> <input type="number" name="claveM" id="claveM" value='+autor.idAutor+' disabled> </div>',
        columna2='<div class="cel2 Quitable"> <input type="text" name="nombreAutorM" id="nombreAutorM" value="'+autor.nombre+'"></div>',
        columna3='<div class="cel3 Quitable"> <input type="text" name="apellidoAutorM" id="apellidoAutorM" value="'+autor.apellido+'"> </div>',
        columna4='<div class="cel4 Quitable"> '+
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
        '</div>'
        $(claseElemento + ">div").toggleClass("putItInvisible");
        $(claseElemento).append(
            columna1+
            columna2+
            columna3+
            columna4
        );
        $(claseElemento+">div.Quitable svg").click(function(){
            let 
            clave =     $("#claveM").val(),
            nombre =        $("#nombreAutorM").val(),
            apellido =      $("#apellidoAutorM").val()
            /*$http.post('modificarAutor',{}).then(
                function(response){
                    let datoRespuesta = response.data;
                    if(datoRespuesta){

                    }
                },
                function(response){
                    $scope.mensId = "Error de conexion al tratar de modificar";
                }
            );*/
            console.log([clave,nombre,apellido]);
            $(".Quitable").remove();
            $scope.listAutores[thisindex].nombre = nombre;
            $scope.listAutores[thisindex].apellido = apellido;
            $(claseElemento + ">div").toggleClass("putItInvisible");
            $scope.$apply();
        });
    }
});
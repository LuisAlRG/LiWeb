var app = angular.module('allApp',[]);
var marcador = null;

$("tbiAutor").attr(
    {'ng-if':"situacionCase == 0"}
);

$("botonesDeAccion>div>div:nth-child(1)").attr(
    {'ng-show':"situacionCase != 0"}
);

$("botonesDeAccion>div>div:nth-child(5), botonesDeAccion>div>div:nth-child(4), botonesDeAccion>div>div:nth-child(3)").attr(
    {'ng-show':"situacionCase == 0"}
);

$("botonesDeAccion>div>div:nth-child(3)").attr(
    {'ng-click':"situacionCase = 1"}
);
$("botonesDeAccion>div>div:nth-child(4)").attr(
    {'ng-click':"situacionCase = 2"}
);
$("botonesDeAccion>div>div:nth-child(5)").attr(
    {'ng-click':"situacionCase = 3"}
);
$("botonesDeAccion>div>div:nth-child(6)").attr(
    {
        'ng-show':"situacionCase != 0",
        'ng-click':"situacionCase = 0"
    }
);
$("detalleLibro").attr(
    {'ng-show':"situacionCase == 0",}
);

//tbiAutor
$("accionesInputs>div:nth-child(2)").attr(
    {'ng-if':"situacionCase == 1"}
);

$("tbiAutor").attr(
    {'ng-if':"situacionCase == 1"}
);
$("tbiAutor>.cuerpoEntero>section").attr(
    {
        'ng-repeat':"autor in listAutorMos track by $index",
        'ng-init':"mostElemento=false"
    }
);
$("tbiAutor>.cuerpoEntero>section>div").attr(
    {'ng-click':"mostElemento=((mostElemento && (indxSAutors == $index)) ? false : true); setIndxSAutors($index) ;"}
);
$("tbiAutor>.cuerpoEntero>section>div:nth-child(4)").attr(
    {'ng-click':""}
);
$("tbiAutor>.cuerpoEntero>section>.elementComplete").attr(
    {
        'ng-if':"mostElemento && (indxSAutors == $index)",
        'ng-click':""
    }
);
//tbiEditorial
$("accionesInputs>div:nth-child(3)").attr(
    {'ng-if':"situacionCase == 2"}
);

$("tbiEditorial").attr(
    {'ng-if':"situacionCase == 2"}
);
$("tbiEditorial>.cuerpoEntero>section").attr(
    {
        'ng-repeat':"editorial in listEditoMos track by $index",
        'ng-init':"mostElemento=false"
    }
);
$("tbiEditorial>.cuerpoEntero>section>div").attr(
    {'ng-click':"mostElemento=((mostElemento && (indxSEditor == $index)) ? false : true); setIndxSEditor($index) ;"}
);
$("tbiEditorial>.cuerpoEntero>section>div:nth-child(3)").attr(
    {'ng-click':""}
);
$("tbiEditorial>.cuerpoEntero>section>.elementComplete").attr(
    {
        'ng-if':"mostElemento && (indxSEditor == $index)",
        'ng-click':""
    }
);
//tbiGeneros
$("accionesInputs>div:nth-child(4)").attr(
    {'ng-if':"situacionCase == 3"}
);
$("tbiGeneros").attr(
    {'ng-if':"situacionCase == 3"}
);
$("tbiGeneros>.cuerpoEntero>section").attr(
    {
        'ng-repeat':"genero in listGeneroMos track by $index",
        'ng-init':"mostElemento=false"
    }
);
$("tbiGeneros>.cuerpoEntero>section>div").attr(
    {'ng-click':"mostElemento=((mostElemento && (indxSGenero == $index)) ? false : true); setIndxSGenero($index) ;"}
);
$("tbiGeneros>.cuerpoEntero>section>div:nth-child(3)").attr(
    {'ng-click':""}
);
$("tbiGeneros>.cuerpoEntero>section>.elementComplete").attr(
    {
        'ng-if':"mostElemento && (indxSGenero == $index)",
        'ng-click':""
    }
);
app.controller('allController',function($scope,$http){
    $scope.situacionCase = 0;

    $scope.indxSAutors=-1;
    $scope.indxSEditor=-1;
    $scope.indxSGenero=-1;

    $scope.listAutorMos=[
        {id:01,nombre:"Luisito",apellido:"Rodriguez"}
    ];
    $scope.listEditoMos=[
        {id:1,
            nombre:"Editoriales Illuminatus",
        },
        {id:2,
            nombre:"McGrawHill"
        }
    ];
    $scope.listGeneroMos=[
        new Genero(2,"Ciencia Fixion"),
        new Genero(5,"Terror")
    ];
    
    //lista mostrable
    $scope.listBusqAutor = [];
    $scope.listBusqEditorial = [];
    $scope.listBusqGenero = [];
    
    $scope.listCompletoAutor = [
        new Autor(0,"Herman","Cortes")
    ];
    for(let i=1;i<15;i++){
        let numeroAletorio = parseInt(Math.random() * 100);
        let generarNombre1= ((numeroAletorio%8==0)?"Luis":(numeroAletorio%6==0)?"Fernando":(numeroAletorio%4==0)?"Memo":(numeroAletorio%2==0)?"Pedro":"Jose");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarNombre2= ((numeroAletorio%8==0)?"de la Casa":(numeroAletorio%6==0)?"Carmino":(numeroAletorio%4==0)?"Gillermo":(numeroAletorio%2==0)?"Kristino":"");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarApellido1= ((numeroAletorio%8==0)?"Rodriguez":(numeroAletorio%6==0)?"Gonzalez":(numeroAletorio%4==0)?"Manriquez":(numeroAletorio%2==0)?"Berzunsa":"");
        numeroAletorio = parseInt(Math.random() * 100);
        let generarApellido2= ((numeroAletorio%8==0)?"Gonzalez":(numeroAletorio%6==0)?"Aguilar":(numeroAletorio%4==0)?"Zapata":(numeroAletorio%2==0)?"":"Jonstar");
        $scope.listCompletoAutor.push(
            new Autor(
                i,
                generarNombre1+" "+generarNombre2,
                generarApellido1+" "+generarApellido2
            )
        );
    }

    $scope.listCompletoEditorial = [
        new Editorial(0,"Editoriales Illuminatus"),
        new Editorial(1,"McGrawHill"),
        new Editorial(2,"All Nigth"),
        new Editorial(3,"Off Day"),
        new Editorial(4,"Readers Digest")
    ];
    $scope.listCompletoGenero = [
        new Genero(0,"Novela"),
        new Genero(1,"Romanse"),
        new Genero(2,"Ciencia Fixion"),
        new Genero(3,"Historico"),
        new Genero(4,"De epoca"),
        new Genero(5,"Terror"),
        new Genero(6,"Manga")
    ];

    $scope.setIndxSAutors = function(indx){
        $scope.indxSAutors = indx;
    }
    $scope.setIndxSEditor = function(indx){
        $scope.indxSEditor = indx;
    }
    $scope.setIndxSGenero = function(indx){
        $scope.indxSGenero = indx;
    }


    //on busqueda
    $scope.onBuscarAutorNombre = function(texto, event){
        texto = PrepararTextoBusqueda(texto);
        $scope.listBusqAutor = $scope.listCompletoAutor?.filter(autor => autor.nombre.toUpperCase().includes(texto));
        if($scope.listBusqAutor.length>3){
            $scope.listBusqAutor.length = 3;
        }
    }
    $scope.onBuscarAutorApellido = function(texto, event){
        texto = PrepararTextoBusqueda(texto);
        $scope.listBusqAutor = $scope.listCompletoAutor?.filter(autor => autor.apellido.toUpperCase().includes(texto));
        if($scope.listBusqAutor.length>3){
            $scope.listBusqAutor.length = 3;
        }
    }
    $scope.onBuscarEditorial = function(texto, event) { 
        texto = PrepararTextoBusqueda(texto);
        $scope.listBusqEditorial = $scope.listCompletoEditorial?.filter(editorial => editorial.nombre.toUpperCase().includes(texto) );
        if($scope.listBusqEditorial.length>3){
            $scope.listBusqEditorial.length = 3;
        }
    };
    $scope.onBuscarGenero = function(texto, event){
        texto = PrepararTextoBusqueda(texto);
        //texto +=  String.fromCharCode(event.keyCode)
        
        $scope.listBusqGenero = $scope.listCompletoGenero?.filter(genero => genero.nombre.toUpperCase().includes(texto) );
        if($scope.listBusqGenero.length>3){
            $scope.listBusqGenero.length = 3;
        }
    }



    $scope.onDesplegarClaveAutor = function(event,numero){
        if(event.keyCode == 13){
            if(numero != undefined){
                let elemento =$scope.listCompletoAutor?.find(autor => autor.idAutor == numero);
                if(elemento != undefined){
                    $scope.nombreAutorB = elemento.nombre;
                    $scope.apellidoAutorB = elemento.apellido;
                }
                else{
                    $scope.nombreAutorB = "";
                    $scope.apellidoAutorB = "";
                }
            }
        }
        
    }
});

var PrepararTextoBusqueda = function(texto){
    texto = texto != undefined ?  texto : '';
    texto = texto.toUpperCase();
    return texto;
}
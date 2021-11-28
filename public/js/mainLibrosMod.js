var app = angular.module('allApp',[]);
var marcador = null;
const SECCION_ACTUAL = "/Libro";
const ESPACIO_BACIO_G = "Escriba algo para considerarse como \"Generp\"";
const ESPACIO_BACIO_A = "Requerimos un nombre o un apellido para considerarse como \"Autor\"";
const ESPACIO_BACIO_E = "Si modifica editorial al menos escribelo como \"editorial\"";

$("tbiAutor").attr(
    {'ng-if':"situacionCase == 0"}
);

$("botonesDeAccion>div>div:nth-child(2), botonesDeAccion>div>div:nth-child(3)").attr(
    {'ng-show':"situacionCase == 0"}
);

$("botonesDeAccion>div>div:nth-child(2)").attr(
    {'ng-click':"situacionCase = 1"}
);

$("botonesDeAccion>div>div:nth-child(3)").attr(
    {'ng-click':"situacionCase = 3"}
);
$("botonesDeAccion>div>div:nth-child(4)").attr(
    {
        'ng-show':"situacionCase != 0",
        'ng-click':"situacionCase = 0 ;mensajeAdicion = null; mensajeQuitar = null;"
    }
);
$("detalleLibro").attr(
    {'ng-show':"situacionCase == 0"}
);

//tbiAutor

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

//tbiGeneros
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
    $scope.indxSGenero=-1;

    $scope.listAutorMos=[
        new Autor(0,"Cargando","Espere")
    ];
    $scope.listGeneroMos=[
        new Genero(0,"Cargando")
    ];
    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Autor",
        {
            clave:$("#libroID").val()
        }
    ).then(
        function(rensopne) {
            let datos = rensopne.data;
            console.log(datos);
            $scope.listAutorMos = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listAutorMos=[
                new Autor(-1,"No se a podido cargar.","Intente de nuevo mas tarde")
            ];
        }
    );
    
    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Genero",
        {
            clave:$("#libroID").val()
        }
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listGeneroMos = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listGeneroMos=[
                new Genero(-1,"No se a podido cargar. Intente de nuevo mas tarde")
            ];
        }
    );

    
    //lista mostrable
    $scope.listBusqAutor = [];
    $scope.listBusqEditorial = [];
    $scope.listBusqGenero = [];
    
    $scope.listCompletoAutor = [
        new Autor(0,"Cargando","Espere")
    ];

    $http.post(DIRECCION_HTTPS+"/Libros/Autores"+"/VerTodos",
        {}
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listCompletoAutor = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listCompletoAutor=[
                new Autor(-1,"No se a podido cargar","Intente de nuevo mas tarde")
            ];
        }
    );

    $scope.listCompletoEditorial = [
        new Editorial(0,"Cargando")
    ];

    $http.post(DIRECCION_HTTPS+"/Libros/Editoriales"+"/VerTodos",
        {}
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listCompletoEditorial = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listCompletoEditorial=[
                new Editorial(-1,"No se a podido cargar. Intente de nuevo mas tarde")
            ];
        }
    );

    $scope.listCompletoGenero = [
        new Genero(0,"Cargando")
    ];

    $http.post(DIRECCION_HTTPS+"/Libros/Generos"+"/VerTodos",
        {}
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listCompletoGenero = datos;
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listCompletoGenero=[
                new Genero(-1,"No se a podido cargar. Intente de nuevo mas tarde")
            ];
        }
    );


    $scope.setIndxSAutors = function(indx){
        $scope.indxSAutors = indx;
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
    }
    $scope.setIndxSEditor = function(indx){
        $scope.indxSEditor = indx;
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
    }
    $scope.setIndxSGenero = function(indx){
        $scope.indxSGenero = indx;
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
    }

    //on busqueda directa
    $scope.onBuscarAutorNombre = function(texto, event){
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        texto = PrepararTextoBusqueda(texto);
        //$scope.idAutorB="";
        $("#idAutorB").val("");
        $scope.listBusqAutor = $scope.listCompletoAutor?.filter(
            autor => 
                autor.nombre?.toUpperCase().includes(texto)
            
        );
        if($scope.listBusqAutor.length>3){
            $scope.listBusqAutor.length = 3;
        }
    }
    $scope.onBuscarAutorApellido = function(texto, event){
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        texto = PrepararTextoBusqueda(texto);
        $("#idAutorB").val("");
        $scope.listBusqAutor = $scope.listCompletoAutor?.filter(
            autor => 
                autor.apellido?.toUpperCase().includes(texto)
        );
        if($scope.listBusqAutor.length>3){
            $scope.listBusqAutor.length = 3;
        }
    }
    $scope.OnBuscarEditorial = function(texto, event) { 
        texto = $("#nombreEditorialM").val();
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        texto = PrepararTextoBusqueda(texto);
        $("#claveEditorialM").val("");
        $scope.listBusqEditorial = $scope.listCompletoEditorial?.filter(
            editorial => 
                editorial.nombre?.toUpperCase().includes(texto) 
        );
        if($scope.listBusqEditorial.length>3){
            $scope.listBusqEditorial.length = 3;
        }
    };
    $scope.onBuscarGenero = function(texto, event){
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        texto = PrepararTextoBusqueda(texto);
        $("#idGeneroB").val("");
        $scope.listBusqGenero = $scope.listCompletoGenero?.filter(
            genero => 
                genero.nombre?.toUpperCase().includes(texto) 
        );
        if($scope.listBusqGenero.length>3){
            $scope.listBusqGenero.length = 3;
        }
    }

    $scope.onDesplegarClaveAutor = function(event,numero){
        //if(event.keyCode == 13){
            if(numero != undefined){
                let elemento =$scope.listCompletoAutor?.find(autor => autor.idAutor == numero);
                if(elemento != undefined){
                    $("#nombreAutorB").val(elemento.nombre);
                    $("#apellidoAutorB").val(elemento.apellido);
                }
                else{
                    $("#nombreAutorB").val("");
                    $("#apellidoAutorB").val("");
                }
            }
            else{
                $("#nombreAutorB").val("");
                $("#apellidoAutorB").val("");
            }
        //}
    }
    $scope.OnDesplegarClaveEditorial = function(event, numero){
        //if(event.keyCode == 13){
            //numero = $("claveEditorialM");
            if( numero != undefined){
                let elemento =$scope.listCompletoEditorial?.find(editorial => editorial.idEditorial == numero);
                if(elemento != undefined){
                    $("#nombreEditorialM").val(elemento.nombre);
                }
                else{
                    $("#nombreEditorialM").val("");
                }
            }
            else{
                $("#nombreEditorialM").val("");
            }
        //}
    }
    $scope.onDesplegarClaveGenero = function(event,numero){
        //if(event.keyCode == 13){
            if(numero != undefined){
                let elemento =$scope.listCompletoGenero?.find(genero => genero.idGenero == numero);
                if(elemento != undefined){
                    $("#nombreGeneroB").val(elemento.nombre);
                }
                else{
                    $("#nombreGeneroB").val("");
                }
            }
            else{
                $("#nombreGeneroB").val("");
            }
        //}
    }

    //Eentos
    $scope.OnModificarLibro = function(){
        let enviar = {
            idLibro:    $("#libroClaveM").val(),
            titulo:     $("#libroTituloM").val(),
            precio:     $("#libroPrecioM").val(),
            edicion:    $("#libroEdicionM").val(),
            cantidad:   $("#libroCantidadM").val(),
            idEditorial:$("#claveEditorialM").val(),
            nombre:     $("#nombreEditorialM").val()
        };
        $scope.mensajeModificar = "";
        if(isEmptyOrSpaces(enviar.titulo)){
            $scope.mensajeModificar += "Titulo Vacio \n";
        }
        if(isEmptyOrSpaces(enviar.precio)){
            $scope.mensajeModificar += "Precio Vacio \n";
        }
        else{
            if(enviar.precio<0)
                $scope.mensajeModificar += "Precio Es negativo \n";
        }
        if(isEmptyOrSpaces(enviar.edicion)){
            $scope.mensajeModificar += "Edicion Vacio \n";
        }
        else{
            if(enviar.edicion<0)
                $scope.mensajeModificar += "Edicion es negativo \n";
        }
        if(isEmptyOrSpaces(enviar.idEditorial) && isEmptyOrSpaces(enviar.nombre)){
            $scope.mensajeModificar += "Editorial Vacio \n";
        }
        //revisar si no hay errores
        if(!isEmptyOrSpaces($scope.mensajeModificar)){
            $scope.mensajeModificar = "No se puede modificar libro por los siguiente(s) problema(s): \n"+
                $scope.mensajeModificar;
            return true;
        }
        //pasando la verificacion
        $scope.mensajeModifica=null;
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Modificar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == null){
                    $scope.mensajeModificar = "No se pudo modificar"
                }
                $scope.mensajeCorrecto = "Modificacion realizada";
                $("#libroClaveM").val(datos.libro.idLibro);
                $("#libroTituloM").val(datos.libro.titulo);
                $("#libroPrecioM").val(datos.libro.precio);
                $("#libroEdicionM").val(datos.libro.edicion);
                $("#libroCantidadM").val(datos.libro.cantidad);
                $("#claveEditorialM").val(datos.editorial.idEditorial);
                $("#nombreEditorialM").val(datos.editorial.nombre);
            },
            function(response){
                FatalErrorPeticion(response,$scope.mensajeModificar);
            }
        );
    }
    
    $scope.OnAderirAutor = function(idLibro){
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        let enviar = {
            idLibro:    idLibro,
            clave:      $("#idAutorB").val(),
            nombre:     $("#nombreAutorB").val(),
            apellido:   $("#apellidoAutorB").val()
        };
        if(isEmptyOrSpaces(enviar.nombre) && isEmptyOrSpaces(enviar.apellido)){
            $scope.mensajeAdicion=ESPACIO_BACIO_A;
            return true;
        }
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/AderirAutor",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == "re"){
                    $scope.mensajeAdicion="Este autor ya esta agregado";
                    //$("#mensajeAdicion").val("Este autor ya esta agregado");
                    return true;
                }
                $scope.listAutorMos.push(datos);
                $("#idAutorB").val("");
                $("#nombreAutorB").val("");
                $("#apellidoAutorB").val("");
            },
            function(response){
                FatalErrorPeticion(response,$scope.mensajeAdicion);
            }
        );
    }

    $scope.OnQuitarAutor = function(idLibro,idAutor,indexLista) {
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        let enviar = {
            idLibro:    idLibro,
            clave:      idAutor
        };
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/QuitarAutor",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(!datos){
                    $scope.mensajeQuitar="ErrorFatal";
                }
                if(datos == "no"){
                    $scope.mensajeQuitar="Solo tiene un elemento, quitarlo seria fatal";
                    return true;
                }
                $scope.listAutorMos.splice(indexLista,1);
            },
            function(response){
                FatalErrorPeticion(response,$scope.mensajeAdicion);
            }
        );
    }
 
    $scope.OnAderirGenero= function(idLibro){
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        let enviar = {
            idLibro:    idLibro,
            clave:      $("#idGeneroB").val(),
            nombre:     $("#nombreGeneroB").val()
        };
        if(isEmptyOrSpaces(enviar.nombre)){
            $scope.mensajeAdicion=ESPACIO_BACIO_G;
            return true;
        }
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/AderirGenero",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == "re"){
                    $scope.mensajeAdicion="Este genero ya esta agregado";
                    //$("#mensajeAdicion").val("Este autor ya esta agregado");
                    return true;
                }
                $scope.listGeneroMos.push(datos);
                $("#idGeneroB").val("");
                $("#nombreGeneroB").val("");
            },
            function(response){
                FatalErrorPeticion(response,$scope.mensajeAdicion);
            }
        );
    }

    $scope.OnQuitarGenero = function(idLibro,idGenero,indexLista) {
        $scope.mensajeQuitar= null;
        $scope.mensajeAdicion= null;
        let enviar = {
            idLibro:    idLibro,
            clave:      idGenero
        };
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/QuitarGenero",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(!datos){
                    $scope.mensajeQuitar="ErrorFatal";
                    return true;
                }
                if(datos == "no"){
                    $scope.mensajeQuitar="Solo tiene un elemento, quitarlo seria fatal";
                    return true;
                }
                $scope.listGeneroMos.splice(indexLista,1);
            },
            function(response){
                FatalErrorPeticion(response,$scope.mensajeAdicion);
            }
        );
    }

    let FatalErrorPeticion = function(response,lugarMensaje){
        let datos = response.data;
        console.log(datos);
        lugarMensaje = ERROR_PETICION;
        //$(lugarMensaje).text(ERROR_PETICION);
    }
});

var PrepararTextoBusqueda = function(texto){
    texto = texto != undefined ?  texto : '';
    texto = texto.toUpperCase();
    return texto;
}
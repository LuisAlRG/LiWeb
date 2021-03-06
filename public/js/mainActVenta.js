var app = angular.module('allApp',[]);
var marcador = null;

$("tablaInfo.elementoDisponible>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"libros in listLibros track by $index",
        'ng-init':"mostElemento=false",
        'ng-show':"MostrarLirbo(libros)"
    }
);

$("tablaInfo.elementoDisponible>div>#cuerpoEntero>section>.elementComplete").attr(
    {
        'ng-if':"mostElemento"
    }
);

$("tablaInfo.elementoSeleccionado>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"libros in listLibrosSelect track by $index",
        'ng-init':"mostElemento=false"
    }
);

$("tablaInfo>div>div>section>div").attr(
    {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
);

$("tablaInfo>div>div>section>div.cel6").attr(
    {'ng-click': ""}
);

$("tablaInfo>div>div>section>div.elementComplete").attr(
    {'ng-if':"mostElemento && indxSelecionado == $index"}
);


app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    let primerElemento = new Libro(0,1,//id libro id editorial
        "Cargando",//titulo
        440,//precio
        1,//edicion
        1//cantidad
    );
    $scope.listLibros=[
        primerElemento
    ];

    $http.post(DIRECCION_HTTPS+"/RealizarVenta/VerTodoLibros",
        {
            _token:$scope.tokenUsr3
        }
    ).then(
        function(rensopne){
            let datos = rensopne.data;
            console.log(datos);
            $scope.listLibros = datos;
            cargarLocal();
        },
        function(response){
            let datos = response.data;
            console.log(datos);
            $scope.listLibros=[
                new Libro(-1,1,//id libro id editorial
                "Hoy no es un buen día para venta, error de conexion",//titulo
                440,//precio
                1,//edicion
                1//cantidad
            )];
        }
    );

    $scope.listLibrosSelect = [];

    $scope.precioTotal = 0;

    $scope.indxSelecionado = 0;

    $scope.filtros=[
        {nombre:"Mayor al precio", value:1},
        {nombre:"Menor al precio", value:2}
    ];

    //cargar posible localstorage
    let elementosGuardados = localStorage.getItem("guardado");
    let cargarLocal = function(){
        if(elementosGuardados!=null){
            elementosGuardados = elementosGuardados;
            if(elementosGuardados == "true"){
                let locCliente = localStorage.getItem("cliente");
                let locLibroSelct = localStorage.getItem("librosSelct");
                let locLibrosCantidad = localStorage.getItem("librosCantidad");
                $scope.cliente = '';
                if(locCliente && !locCliente?.includes("undefined")){
                    $scope.cliente = locCliente?locCliente:'';
                }
                
                locLibroSelct = locLibroSelct.split(' ');
                locLibrosCantidad = locLibrosCantidad.split(' ');

                $scope.listLibros.forEach( (libroSel,index) => {
                    for(let i=0; locLibroSelct.length > i; i++){
                        if(libroSel.idLibro == parseInt(locLibroSelct[i])){
                            let cantidadElegida = parseInt(locLibrosCantidad[i])
                            for(let j=0; cantidadElegida > j; j++ ){
                                $scope.accionAderirSeleccion(index);
                            }
                            //libroSel.cantidad = parseInt(locLibrosCantidad[i]);
                            break;
                        }
                    }
                });
                //localStorage.setItem("guardado",false);
            }
        }
    }

    //funciones de llamada
    
    $scope.QuitarEnLocalStorage = function(){
        localStorage.setItem("guardado",false);
    }

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
    //Condicion de mostrado
    $scope.accionAderirSeleccion = function(index){
        if(!$scope.listLibros[index].agotado){
            $scope.listLibros[index].cantidad--;
            $scope.listLibrosSelect.push($scope.listLibros[index]);
        }
        totalPrecio()
    }

    $scope.MostrarLirbo= function(libro){
        let cantidad = libro.cantidad;
        return cantidad > 0;
    }
    
    $scope.RecordarCantidad = function(libro){
        let cantidad = libro.cantidad;
        $scope.listLibrosSelect.array.forEach(libroSel => {
            if(libroSel.cantidad == libro.cantidad){
                cantidad--;
            }
        });
        return cantidad;
    }

    $scope.accionRemoverSeleccion = function(index){
        let elementSacado = $scope.listLibrosSelect[index];
        $scope.listLibrosSelect.splice(index,1);
        let indexListaTotal = $scope.listLibros.findIndex(libro=>libro.idLibro == elementSacado.idLibro);
        $scope.listLibros[ indexListaTotal ].cantidad++;
        totalPrecio()
    }

    $scope.mostrarBtnVenta = function(){
        return $scope.listLibrosSelect.length > 0;
    }

    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }

    function totalPrecio() { 
        $scope.precioTotal = 0;
        $scope.listLibrosSelect.forEach(element => {
            $scope.precioTotal += parseFloat(element.precio);
        });
    }

    $scope.OnBuscarLibro = function(){
        let envio = {
            _token: $("#tokenUsr1").val(),
            clave: $scope.clave,
            tituloLibro: $scope.tituloLibro,
            precio: $scope.precio,
            categoria: $scope.categoria.value
        }
        console.log(envio);
        $http.post(DIRECCION_HTTPS+"/RealizarVenta/ConsultarLibros",
            envio
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos)
                    if(datos[0]){
                        $scope.listLibros = datos;
                        return 1;
                    }
                        

                $scope.listLibros=[
                    new Libro(0,1,//id libro id editorial
                    "No hay libro con esa información",//titulo
                    440,//precio
                    1,//edicion
                    1//cantidad
                )];
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.listLibros=[
                    new Libro(-1,1,//id libro id editorial
                    "Hoy no es un buen día para venta, error de conexion",//titulo
                    440,//precio
                    1,//edicion
                    1//cantidad
                )];
            }
        );
    }


    $scope.DisableIfClave = function(){
        if($scope.clave === undefined)
            return false;
        return $scope.clave >0;
    }

    $scope.AccionRealizarVenta = function(){
        let sentCliente=    $scope.cliente;
        let listaNoRepetido=[];
        for(let i=0;i<$scope.listLibrosSelect.length;i++){
            let findIndex = listaNoRepetido.findIndex(libro=>libro.idLibro == $scope.listLibrosSelect[i].idLibro);
            if(findIndex != -1){
                listaNoRepetido[findIndex].cantidadSeleccionado++;
            }
            else{
                listaNoRepetido.push($scope.listLibrosSelect[i]);
                listaNoRepetido[listaNoRepetido.length-1].cantidadSeleccionado=1;
            }
        }
        $scope.librosSelct = listaNoRepetido.map(libro=> libro.idLibro).join(" ");
        $scope.librosCantidad = listaNoRepetido.map(libro=> libro.cantidadSeleccionado).join(" ");

        let sentLibrosSelct = $scope.librosSelct;
        let sentLibrosCantidad = $scope.librosCantidad;

        $("#librosSelct").val(sentLibrosSelct);
        $("#librosCantidad").val(sentLibrosCantidad);

        let sentItemsLog={
            cliente:sentCliente,
            librosSelect:sentLibrosSelct,
            librosCantidad:sentLibrosCantidad
        }

        console.log(sentItemsLog);

        let nombreid = "realizarCompra";

        //usar local storage
        localStorage.setItem("guardado",true);
        localStorage.setItem("cliente",sentCliente);
        localStorage.setItem("librosSelct",sentLibrosSelct);
        localStorage.setItem("librosCantidad",sentLibrosCantidad);

        document.getElementById(nombreid).submit();
    }
});

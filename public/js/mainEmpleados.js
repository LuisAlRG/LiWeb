var app = angular.module('allApp',[]);
var marcador = null;
const SECCION_ACTUAL = "/Empleados"

$("tablaInfo>div>#cuerpoEntero>section").attr(
    {
        'ng-repeat':"empleado in listEmpleado track by $index",
        'ng-init':"mostElemento=false"
    }
);



$("tablaInfo>div>div>section>div").attr(
    {'ng-click': "mostElemento=((mostElemento && (indxSelecionado == $index)) ? false : true); setIndxSelecionado($index) ;"}
);

$("tablaInfo>div>div>section>div.cel5").attr(
    {'ng-click': ""}
);

$("tablaInfo>div>div>section>div.elementComplete").attr(
    {'ng-if':"mostElemento && indxSelecionado == $index"}
);

$(".modificarEmpleado").attr(
    {'ng-click':"OnModificarEmpleado(empleado,$index)"}
);

app.controller('allController',function($scope,$http){
    //inicialisar valores globales
    $scope.listEmpleado = [
        new Empleado(
            0,0,
            "Cargando",
            "Empleado",
            "claro que si",
            true,
            true,
            "Funcionario"
        )
    ]
    
    $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/VerTodoEmpleado",
            {
                _token:$scope.tokenUsr2
            }
        ).then(
            function(rensopne){
                let datos = rensopne.data;
                console.log(datos);
                $scope.listEmpleado = datos;
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.listEmpleado=[
                    new Empleado(
                        -1,-1,
                        "No se pudo cargar",
                        "A los Empleados",
                        "lastima",
                        false,
                        false,
                        "Funcionario"
                    )
                ];
            }
        );

    $scope.indxSelecionado = 0;

    $scope.roles=[
        {nombre:"Funcionario", value:1},
        {nombre:"Administrador", value:2},
        {nombre:"Gerente", value:3}
    ];

    $scope.filtroRoles=[
        {nombre:"Sin filtro", value:0},
        {nombre:"Funcionario", value:1},
        {nombre:"Administrador", value:2},
        {nombre:"Gerente", value:3},
    ];

    //formatos
    $scope.FormatoRol = function(rol){
        let cadena = "Error"
        switch(rol){
            case 1: cadena = "Funcionario"; break; //funcionario
            case 2: cadena = "Administrador"; break; //administrador
            case 3: cadena = "Gerente"; break; //gerente
        }
        return cadena;
    }
    //funciones de llamada
    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
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

    $scope.OnContratarToggle = function (empleado) {
        $("tablaInfo").prop("disabled",true);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Contratado",
            {
                _token:$scope.tokenUsr2,
                clave:empleado.idEmpleado,
                contratado:empleado.contratado
            }
        ).then(
            function(rensopne){
                $("tablaInfo").prop("disabled",false);
                let datos = rensopne.data;
                console.log(datos);
            },
            function(response){
                $("tablaInfo").prop("disabled",false);
                let datos = response.data;
                console.log(datos);
            }
        );
        empleado.contratado = !empleado.contratado;
    }
    //Eventos
    $scope.OnInsertarEmpleado = function (){
        let enviar = {
            nombreEmpleado: $scope.nombreEmpleado,
            apellidoEmpleado: $scope.apellidoEmpleado,
            passEmpleado: $scope.passEmpleado,
            rolEmpleado: $scope.rolEmpleado.value
        }
        console.log(enviar);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Insertar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos == "re"){
                    $scope.mensajeInsertar = "Contraseña repetida, intente con otra";
                    return true;
                }
                $scope.nombreEmpleado = undefined;
                $scope.apellidoEmpleado = undefined;
                $scope.passEmpleado = undefined;
                $scope.rolEmpleado = $scope.roles[0];
                $scope.listEmpleado.push(datos);
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.mensajeInsertar = ERROR_PETICION;
            }
        );
    }

    $scope.OnBuscarEditorial = function(){
        let enviar = {
            clave:      $scope.clave,
            nombre:     $scope.nombre,
            apellido:   $scope.apellido,
            rolSelect:  $scope.rolSelect.value
        }
        console.log(enviar);
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Consultar",
            enviar
        ).then(
            function(response){
                let datos = response.data;
                console.log(datos);
                if(datos)
                    if(datos[0]){
                        $scope.listEmpleado = datos;
                        return 1;
                    }
                $scope.listEmpleado=[
                    new Empleado(
                        -1,-1,
                        "No hay empleados",
                        "No hay empleados con",
                        "esta descripcio",
                        false,
                        false,
                        "Funcionario"
                    )
                ];
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.listEmpleado=[
                    new Empleado(
                        -1,-1,
                        "No se a podido cargar.",
                        "No se a podido cargar.",
                        "Intentelo de nuevo mas tarde",
                        false,
                        false,
                        0
                    )
                ];
            }
        );
    }

    $scope.OnBorrarEmpleado = function(clave, indexLista){
        let envio = {
            clave: clave
        }
        
        $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Borrar",
            envio
        ).then(
            function(rensopne){
                let datos = rensopne.data;
                console.log(datos);
                if(datos == "no"){
                    $scope.mensajeBorrar = "Este empleado tiene ventas realizada, solo podemos despedirlos";
                    return true;
                }
                $scope.listEmpleado.splice(indexLista,1);
            },
            function(response){
                let datos = response.data;
                console.log(datos);
                $scope.mensajeInsertar = "Error en la peticion, intentelo mas tarde";
            }
        );
    }

    $scope.OnModificarEmpleado = function (empleado, thisindex) {
        console.log(empleado);
        let claseElemento = ".element"+empleado.idEmpleado;
        console.log(claseElemento);
        $scope.indxSelecionadoOp = -1;
        $scope.indxSelecionado = -1;
        let 
        encabexado='<div class="cel1 Quitable"> <span>Nombre</span> </div>'+
        '<div class="cel2 Quitable"> <span>Apellido</span> </div>'+
        '<div class="cel3 Quitable"> <span> Clave (dejar vacio para conservar)</span> </div>'+
        '<div class="cel4 Quitable"> <span>Rol</span> </div>'+
        '<div class="cel5 Quitable"> <span>Aceptar</span> </div>',
        columna1 = '<div class="cel1 Quitable">'+
        '<input type="text" name="nombreEmpleadoM" id="nombreEmpleadoM" value="'+empleado.nombre+'">'+
        '</div>',
        columna2 = '<div class="cel2 Quitable">'+
        '<input type="text" name="apellidoEmpleadoM" id="apellidoEmpleadoM" value="'+empleado.apellido+'">'+
        '</div>',
        columna3 = '<div class="cel3 Quitable">'+
        '<input type="password" name="passEmpleadoM" id="passEmpleadoM" value="">'+
        '</div>',
        columna4 = '<div class="cel4 Quitable">'+
        '<select name="rolEmpleadoM" id="rolEmpleadoM">'+
            '<option value=1>Funcuionario</option>'+
            '<option value=2>Administrador</option>'+
            '<option value=3>Gerente</option>'+
        '</select>'+
        '</div>',
        columna5 = '<div class="cel5 Quitable">'+
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
            encabexado+
            columna1+
            columna2+
            columna3+
            columna4+
            columna5
        );
        $(claseElemento+">div.Quitable svg").click(function(){
            let enviar = {
                clave:      empleado.idEmpleado,
                nombre:     $("#nombreEmpleadoM").val(),
                apellido:   $("#apellidoEmpleadoM").val(),
                password:   $("#passEmpleadoM").val(),
                rol:        $("#rolEmpleadoM").val()
            }
            console.log(enviar);
            $http.post(DIRECCION_HTTPS+SECCION_ACTUAL+"/Modificar",
                enviar
            ).then(
                function(response){
                    let datos = response.data;
                    console.log(datos);
                    if(datos == "re"){
                        $scope.mensajeModificar = "Nombre repetido, intente con otro";
                        return true;
                    }
                    $(".Quitable").remove();
                    $scope.listEmpleado[thisindex].nombre =     enviar.nombre;
                    $scope.listEmpleado[thisindex].apellido =   enviar.apellido;
                    $scope.listEmpleado[thisindex].rol =        parseInt(enviar.rol);
                    $(claseElemento + ">div").toggleClass("putItInvisible");
                    //$scope.$apply();
                    $scope.mensajeModificar = null;
                },
                function(response){
                    let datos = response.data;
                    console.log(datos);
                    $scope.mensajeModificar = ERROR_PETICION;
                }
            );
            
        });
    }
});
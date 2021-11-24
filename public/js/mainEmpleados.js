var app = angular.module('allApp',[]);
var marcador = null;

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
            "Luis Alfonso",
            "Rodriguez Gonzalez",
            "Luis Alfonso",
            true,
            true,
            "Gerente"
        ),
        new Empleado(1,1,
            "Kenji",
            "Gonzalez Hoshino",
            "Kenji",
            true,
            false,
            "Administrador"
        ),
        new Empleado(2,2,
            "Jose Luis",
            "Sanchez Sanchez",
            "Jose Luis",
            false,
            false,
            "Funcionario"
        ),
        new Empleado(3,3,
            "Daniel Roman",
            "Nuñez Aguirre",
            "Daniel Roman",
            true,
            false,
            "Funcionario"
        )
    ]
    for(let i=4;i<10;i++){
        $scope.listEmpleado.push(
            new Empleado(i,i,
                "Nombre falso el "+(i-3)+"º",
                "Appelido False",
                "Nombre falso el "+(i-3)+"º",
                true,
                false,
                "Funcionario"
            )
        );
    }

    $scope.indxSelecionado = 0;
    //funciones de llamada


    $scope.setIndxSelecionado = function(elIndex){
        $scope.indxSelecionado = elIndex;
    }

    $scope.OnContratarToggle = function (empleado) {
        empleado.contratado = !empleado.contratado;
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
            let 
            nombre=     $("#nombreEmpleadoM").val(),
            apellido =  $("#apellidoEmpleadoM").val(),
            password =  $("#passEmpleadoM").val(),
            tipo =       $("#rolEmpleadoM").val();
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
            console.log([clave,nombre,apellido,password,tipo]);
            $(".Quitable").remove();
            $scope.listEmpleado[thisindex].nombre = nombre;
            $scope.listEmpleado[thisindex].apellido = apellido;
            $scope.listEmpleado[thisindex].tipo = (tipo==1)?"Funcionario":(rol==2)?"Administrador":(rol==3)?"Gerente":"Error";
            $(claseElemento + ">div").toggleClass("putItInvisible");
            $scope.$apply();
        });
    }
});
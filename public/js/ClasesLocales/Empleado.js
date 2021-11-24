class Empleado{
    constructor(){
        let n = arguments.length;
        let idEmpleado = -1,
        idUser=-1,
        nombre= "",
        apellido="",
        nombreusuario="",
        contratado = false,
        gerente = false,
        tipo = "funcionario";
        switch(n){
            case 8:
                tipo = arguments[7];
            case 7:
                gerente = arguments[6];
            case 6:
                contratado = arguments[5];
            case 5:
                nombreusuario = arguments[4];
            case 4:
                apellido = arguments[3];
            case 3:
                nombre = arguments[2];
            case 2:
                idUser = arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if( typeof posibleNumero != 'number'){
                    idEmpleado =    posibleNumero.idEmpleado,
                    idUser =        posibleNumero.idUser,
                    nombre=         posibleNumero.nombre,
                    apellido=       posibleNumero.apellido,
                    nombreusuario=  posibleNumero.nombreusuario,
                    contratado =    posibleNumero.contratado,
                    gerente =       posibleNumero.gerente,
                    tipo =          posibleNumero.tipo;
                    break;
                }
                idEmpleado = posibleNumero;
        }
        this.idEmpleado =    idEmpleado,
        this.idUser =        idUser,
        this.nombre=         nombre,
        this.apellido=       apellido,
        this.nombreusuario=  nombreusuario,
        this.contratado =    contratado,
        this.gerente =       gerente,
        this.tipo =          tipo;
    }
}
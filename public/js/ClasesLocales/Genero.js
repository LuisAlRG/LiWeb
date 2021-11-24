class Genero{
    constructor(){
        let n = arguments.length;
        let idGenero=-1,nombre="";
        switch(n){
            case 2:
                nombre=     arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if( typeof posibleNumero != 'number' ){
                    idGenero=   posibleNumero.idGenero;
                    nombre=     posibleNumero.nombre;
                    break;
                }
                idGenero=   posibleNumero;
        }
        this.idGenero=  idGenero;
        this.nombre=    nombre;
    }
}
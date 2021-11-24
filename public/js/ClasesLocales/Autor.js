class Autor{
    constructor(){
        let n = arguments.length;
        let idAutor = -1,nombre= "",apellido="";
        switch(n){
            case 3:
                apellido = arguments[2];
            case 2:
                nombre = arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if( typeof posibleNumero != 'number'){
                    idAutor = posibleNumero.idAutor;
                    nombre = posibleNumero.nombre;
                    apellido = posibleNumero.apellido;
                    break;
                }
                idAutor = posibleNumero;
        }
        this.idAutor =  idAutor;
        this.nombre =   nombre;
        this.apellido = apellido;
    }
}
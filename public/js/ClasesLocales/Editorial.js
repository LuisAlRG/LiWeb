class Editorial {
    constructor(){
        let n = arguments.length;
        let idEditorial = -1,nombre= "";
        switch(n){
            case 2:
                nombre = arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if( typeof posibleNumero != 'number'){
                    idEditorial = posibleNumero.idEditorial;
                    nombre = posibleNumero.nombre;
                    break;
                }
                idEditorial = posibleNumero;
        }
        this.idEditorial =  idEditorial;
        this.nombre =       nombre;
    }
}
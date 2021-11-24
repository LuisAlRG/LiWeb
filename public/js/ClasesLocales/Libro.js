class Libro{
    constructor(){
        let n = arguments.length;
        let idLibro=-1,
        idEditorial=-1,
        titulo="0",
        precio=0,
        edicion=1,
        cantidad=0;
        switch(n){
            case 6:
                cantidad = arguments[5];
            case 5:
                edicion = arguments[4];
            case 4:
                precio = arguments[3];
            case 3:
                titulo = arguments[2];
            case 2:
                idEditorial = arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if(typeof posibleNumero != 'number'){
                    idLibro= posibleNumero.idLibro;
                    idEditorial = posibleNumero.idEditorial;
                    titulo = posibleNumero.titulo;
                    precio = posibleNumero.precio;
                    edicion = posibleNumero.edicion;
                    cantidad = posibleNumero.cantidad;
                    break;
                }
                idLibro= posibleNumero;
        }
        this.idLibro =      idLibro;
        this.idEditorial =  idEditorial;
        this.titulo =       titulo;
        this.precio =       precio;
        this.edicion =      edicion;
        this.cantidad =     cantidad;
        this.autores = [];
        this.editorial = "";
    }

    set setEditorial(value){
        this.editorial = value;
    }

    get getEditorial(){
        return this.editorial;
    }

    set addAutor(value){
        this.autores.push(value);
    }
    set addListAutor(list){
        this.autores.push.apply(this.autores,list)
    }
    get getAutores(){
        return this.autores;
    }

    get agotado(){
        return this.cantidad == 0;
    }
}
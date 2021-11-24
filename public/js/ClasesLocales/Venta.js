class Venta{
    constructor(){
        let n = arguments.length;
        let idVenta = -1,
        idEmpleado = -1,
        cliente= "cliente",
        fecha= Date.now();
        switch(n){
            case 4:
                fecha = arguments[3];
            case 3:
                cliente = arguments[2];
            case 2:
                idEmpleado = arguments[1];
            case 1:
                let posibleNumero = arguments[0];
                if( typeof posibleNumero != 'number'){
                    idVenta = posibleNumero.idVenta;
                    idEmpleado = posibleNumero.idEmpleado;
                    cliente = posibleNumero.cliente;
                    fecha = posibleNumero.fecha;
                    break;
                }
                idVenta = posibleNumero;
        }
        this.idVenta =      idVenta;
        this.idEmpleado =   idEmpleado;
        this.cliente =      cliente;
        this.fecha =        fecha;
    }

    
}
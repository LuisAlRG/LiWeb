const DIRECCION_HTTPS = "https://192.168.1.150/LiWeb";
const ERROR_PETICION = "Error en la peticion, intentelo mas tarde, o recarge la paguina"

//funcion para saber si esta vacio o null
//sacado de https://stackoverflow.com/questions/10232366/how-to-check-if-a-variable-is-null-or-empty-string-or-all-whitespace-in-javascri
function isEmptyOrSpaces(str){
    if(str === undefined)
        return true;
    return str === null || str.match(/^ *$/) !== null;
}
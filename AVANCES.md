comenzando el dia 18 11 21
    se guardo de una ves los archivos de migracion de base de datos y la creacion de los modelos relacionales
    se agrego la primera prueba de paguina
    y se modifico las rutas web para tener las direcciones bases del proyecto
    
avance 2 del 18 11 21
    creacion de la pantalla y controllador logico de ventas
    aderir los posibles rutas de llamado de metodos.

avance 3 del 18 11 21
    agregar la pantalla de log in y menu principal
    especificamente trabaje con el controlado de empleado para autenticar y cerar sesion y tambien para mostrar las pantalla de login y menuprincipal
    creacion de seeder esta completo el de autor, editorial, libros
    creacion de seeder Empleados que por ahora solo tiene uno para comprobar log in
    se comprobo y cumplio la posibilidad de iniciar secion con el usuario y cerrarlo

avance 1 del 20 11 21
    modificacion en las clases modelos por nesesidad de tener que cambiar el nombre del id ya que el default de laravel es "id" en ves de "id[modelo]"
    se agrego mas seder probando el agregado de ventas, pero todavia no esta completo

avence 1 del 21 11 21
    Modificacion en libro para que tuviesen autor y generos multiples
    una pequena mejora en el seeder de venta
    Lirbo tiene una megor forma de salvar un elemento
    el logico de empleado (EmpleadoController) tiene la posibilidad de aderir empleado
    sera un dia largo

avance 1 del 24 11 21
    Implementacion de las pantallas de realizar ventas y vender al proyecto, sepuede seleccionar libros y pasarlo a la siguiente hoja
    nota: buscar una manera de usar local storash para poder regresar a la pantalla, nada concreto aun
    Modificaciones mayores en "VentaCOntroles" el cual es sobre la capasidad de regresar las pantallas realizar Ventas y Vender y poder insertar

avance 2 del 24 11 21
    Nos enfocamos en la cuestion del control del empleado, ya existe la pantalla de empleado , y con ellos podemos: ver todos los empleados, contratar / despedir, e insertar
    tambien se agrego la consulta de venta

avance 1 del 25 11 21
    Agrege las pantallas de autor , editorial y genero al mismo que genere los controladores de autor y libro
    ligeras modificaciones de estilos

avance 1 del 26 11 21
    Las pantallas de Autor, Editorial y Genero funciona en su totalidad (consulta, modifica, Inserta y Borra), solo le falta retoques de diseño
    Agregamos la pantalla de Modificacion de libro.
    nota: investigar un poco mas de los midel ware para por fin poder hacer bien la tabla de historial
    nota2: midelware para bloquear el acceso a no funcionario para otras pantallas (Empleados y modificacion de libros)

avance 1 del 27 11 21
    Acceso a la pantalla de Modificar Libro, Todas las funciones para modificar libro ya estan echas (modificar, aderir autor, aderir genero y buscar autor, genero y editorial para el libro)
    Megorando un poco la calidad de las funciones en java script.
    nota: investigar un poco mas de los midel ware para por fin poder hacer bien la tabla de historial
    nota2: midelware para bloquear el acceso a no funcionario para otras pantallas (Empleados y modificacion de libros)

avance 1 del 28 11 21  
    se puede consultar en la pantalla de empleados

avance 2 del 28 11 21
    Se agregaron algunas comprobaciones en las pantallad de empleado, autor, editorial y genero (que muestre algunos mensajes de error en pantalla)
    pantalla libro ya puede hacer consulta y agregar nuevos libros con nuevos autor, editoria y Genero
    
avance 1 del 29 11 21
    Se agrego la pantalla de Historial gunto con ello, se modificaron los controles importantes para que dejase una marca en el historial
    consultar historial es posible
    consultar venta es posible
    tambien avisar que se agrego el archivo logico de historial "HistorialController"
    unos cuantos cambion en los archivos js
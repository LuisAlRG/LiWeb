<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\HistorialController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Aplicacion web

Route::get('/LiWeb',				[EmpleadoController::class,"ViewLogIn"])
	->name('login');
Route::post('/LiWeb/Autenticar',	[EmpleadoController::class,"Autenticar"]);
Route::get('/LiWeb/Saliendo',		[EmpleadoController::class,"Salir"]);

Route::get('/LiWeb/SobreNosotros',	function(){return view('sobreNosotros');});

Route::get('/LiWeb/MenuPrincipal',	[EmpleadoController::class,"ViewMenuPrincipal"])
	->middleware(['auth']);

Route::get('/LiWeb/Venta',					[VentaController::class, 'ViewVentas'])
	->middleware(['auth']);
Route::post('/LiWeb/Venta/VerTodoVenta',	[VentaController::class, 'VerTodosVentas']);
Route::post('/LiWeb/Venta/Consultar',		[VentaController::class, 'ConsultarVentas']);

Route::get('/LiWeb/RealizarVenta',			[VentaController::class, 'ViewVender'])
->middleware(['auth']);
Route::post('/LiWeb/RealizarVenta/VerTodoLibros',	[VentaController::class, 'VerTodosLibros']);
Route::post('/LiWeb/RealizarVenta/ConsultarLibros',	[VentaController::class, 'ConsultarLirbos']);

Route::post('/LiWeb/Vender',						[VentaController::class, 'ViewVenderYa'])
->middleware(['auth']);
Route::post('/LiWeb/Vender/LibrosSeleccionados',	[VentaController::class, 'DesplegarLibrosSeleccionado']);
Route::post('/LiWeb/AplicarVenta',					[VentaController::class, 'InsertarVenta']);

Route::get('/LiWeb/Libros',					[LibroController::class,"ViewLibros"])
	->middleware(['auth']);
Route::post('/LiWeb/Libros/VerTodoLibros',	[LibroController::class,"VerTodosLibros"]);
Route::post('/LiWeb/Libros/Insertar',		[LibroController::class,"InsertarLibro"]);
Route::post('/LiWeb/Libros/Consultar',		[LibroController::class,"ConsultarLibro"]);
Route::post('/LiWeb/Libros/Borrar',			[LibroController::class,"BorrarLibro"]);

Route::get('/LiWeb/Libro',					function(){return redirect('/LiWeb/Libros');});
Route::post('/LiWeb/Libro',					[LibroController::class,'ViewLibroModificar'])
	->middleware(['auth']);
Route::post('/LiWeb/Libro/Modificar',		[LibroController::class,'ModificarLibro']);
Route::post('/LiWeb/Libro/Autor',			[LibroController::class,'SuAutores']);
Route::post('/LiWeb/Libro/AderirAutor',		[LibroController::class,'AderirAutor']);
Route::post('/LiWeb/Libro/QuitarAutor',		[LibroController::class,'QuitarAutor']);
Route::post('/LiWeb/Libro/Genero',			[LibroController::class,'SuGeneros']);
Route::post('/LiWeb/Libro/AderirGenero',	[LibroController::class,'AderirGenero']);
Route::post('/LiWeb/Libro/QuitarGenero',	[LibroController::class,'QuitarGenero']);


Route::get('/LiWeb/Libros/Autores',				[AutorController::class,'ViewAutores'])
	->middleware(['auth']);
Route::post('/LiWeb/Libros/Autores/VerTodos',	[AutorController::class,'VerTodosAutores']);
Route::post('/LiWeb/Libros/Autores/Consultar',	[AutorController::class,'ConsultarAutor']);
Route::post('/LiWeb/Libros/Autores/Insertar',	[AutorController::class,'InsertarAutor']);
Route::post('/LiWeb/Libros/Autores/Modificar',	[AutorController::class,'ModificarAutor']);
Route::post('/LiWeb/Libros/Autores/Borrar',		[AutorController::class,'BorrarAutor']);

Route::get('/LiWeb/Libros/Generos',				[GeneroController::class,'ViewGenero'])
	->middleware(['auth']);
Route::post('/LiWeb/Libros/Generos/VerTodos',	[GeneroController::class,'VerTodoGeneros']);
Route::post('/LiWeb/Libros/Generos/Consultar',	[GeneroController::class,'ConsultarGenero']);
Route::post('/LiWeb/Libros/Generos/Insertar',	[GeneroController::class,'InsertarGenero']);
Route::post('/LiWeb/Libros/Generos/Modificar',	[GeneroController::class,'ModificarGenero']);
Route::post('/LiWeb/Libros/Generos/Borrar',		[GeneroController::class,'BorrarGenero']);

Route::get('/LiWeb/Libros/Editoriales',				[EditorialController::class,'ViewEditorial'])
	->middleware(['auth']);
Route::post('/LiWeb/Libros/Editoriales/VerTodos',	[EditorialController::class,'VerTodosEditoriales']);
Route::post('/LiWeb/Libros/Editoriales/Consultar',	[EditorialController::class,'ConsultarEditorial']);
Route::post('/LiWeb/Libros/Editoriales/Insertar',	[EditorialController::class,'InsertarEditorial']);
Route::post('/LiWeb/Libros/Editoriales/Modificar',	[EditorialController::class,'ModificarEditorial']);
Route::post('/LiWeb/Libros/Editoriales/Borrar',		[EditorialController::class,'BorrarEditorial']);

Route::get('/LiWeb/Empleados',					[EmpleadoController::class,'ViewEmpleados'])
	->middleware(['auth'])->middleware(['checkAdmin']);
Route::post('/LiWeb/Empleados/VerTodoEmpleado',	[EmpleadoController::class,'VerTodoEmpleado']);
Route::post('/LiWeb/Empleados/Contratado',		[EmpleadoController::class,'Contratar']);
Route::post('/LiWeb/Empleados/Consultar',		[EmpleadoController::class,'ConsultarEmpleado']);
Route::post('/LiWeb/Empleados/Insertar',		[EmpleadoController::class,'InsertarUsuario']);
Route::post('/LiWeb/Empleados/Borrar',			[EmpleadoController::class,'BorrarEmpleado']);
Route::post('/LiWeb/Empleados/Modificar',		[EmpleadoController::class,'ModificarUsuario']);


Route::get('/LiWeb/Historial',				[HistorialController::class,'ViewHistorial'])
	->middleware(['auth']);
Route::post('/LiWeb/Historial/VerTodo',		[HistorialController::class,'VerHitorial'])
	->middleware(['auth']);
Route::post('/LiWeb/Historial/Consultar',	[HistorialController::class,'ConsultarHistorial'])
->middleware(['auth']);

require __DIR__.'/auth.php';

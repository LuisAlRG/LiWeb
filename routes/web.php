<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;
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

Route::get('/LiWeb',				[EmpleadoController::class,"ViewLogIn"])->name('login');
Route::post('/LiWeb/Autenticar',	[EmpleadoController::class,"Autenticar"]);
Route::get('/LiWeb/Saliendo',		[EmpleadoController::class,"Salir"]);

Route::get('/LiWeb/MenuPrincipal',	[EmpleadoController::class,"ViewMenoPrincipal"])
	->middleware(['auth']);

Route::get('/LiWeb/Venta',					[VentaController::class, 'ViewVentas'])
	->middleware(['auth']);
Route::post('/LiWeb/Venta/VerTodoVenta',	[VentaController::class, 'VerTodosVentas']);
Route::post('/LiWeb/Venta/Consultar',	[VentaController::class, 'ConsultarVentas']);

Route::get('/LiWeb/RealizarVenta',		[VentaController::class, 'ViewVender'])
->middleware(['auth']);
Route::post('/LiWeb/RealizarVenta/VerTodoLibros',		[VentaController::class, 'VerTodosLibros']);

Route::post('/LiWeb/Vender',						[VentaController::class, 'ViewVenderYa']);
Route::post('/LiWeb/Vender/LibrosSeleccionados',	[VentaController::class, 'DesplegarLibrosSeleccionado']);

Route::get('/LiWeb/Libros',			function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::post('/LiWeb/Libros/Modificar',	function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::get('/LiWeb/Libros/Autores',		function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::get('/LiWeb/Libros/Generos',		function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::get('/LiWeb/Libros/Editoriales',	function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::get('/LiWeb/Empleados',	function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

Route::get('/LiWeb/Historial',	function(){return "<h1>Not Done!!!</h1>";})
	->middleware(['auth']);

require __DIR__.'/auth.php';

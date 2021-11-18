<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/LiWeb',				function(){return "<h1>Not Done!!!</h1>";})->name('login');

Route::get('/LiWeb/MenuPrincipal',	function(){return view('menuPrincipal');})
	->middleware(['auth']);

Route::get('/LiWeb/Venta',					[VentaController::class, 'ViewVentas'])
	->middleware(['auth']);
Route::post('/LiWeb/Venta/VerTodoVenta',	[VentaController::class, 'VerTodosVentas']);
Route::post('/LiWeb/Venta/Consultar',	[VentaController::class, 'ConsultarVentas']);


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

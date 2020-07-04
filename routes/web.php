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



Auth::routes();

Route::get('/', function() {
    return redirect()->route('mostrar');
})->name('home');

//Productos
Route::post('/productos/registro', 'ProductosController@registro')->name('Productoregistro');
Route::get('/producto/registro', 'ProductosController@registro_vista')->name('vista_registro');
Route::get('/producto/mostrar', 'ProductosController@mostrar')->name('mostrar');
Route::get('/producto/eliminar/{id}', 'ProductosController@eliminar')->name('eliminar');
Route::get('/producto/modificar/{id}', 'ProductosController@editar_vista')->name('editar_vista');
Route::post('/producto/editar/{id}', 'ProductosController@editar')->name('editar');
Route::get('/producto/imagen/{file}', 'ProductosController@getImagen')->name('imagen');


//Ventas
Route::get('/ventas/venta/{producto_id}', 'VentasController@ventas_vista')->name('ventas_vista'); //Dirije al formulario 
Route::post('/ventas/proceso/{maquina_id}/{producto_id}', 'VentasController@ventas')->name('ventas'); //Procesa en la base de datos
Route::post('/ventas/maquina/{id}', 'VentasController@ventasMaquina')->name('ventas.maquina'); //Procesa en la base de datos
Route::get('/ventas/allventas', 'VentasController@AllVentas')->name('AllVentas'); //Dirije al formulario 
Route::get('/ventas/allventas_excel', 'VentasController@AllVentas_excel')->name('AllVentas_excel'); //Descarga el archivo
Route::get('/ventas/grafico', 'VentasController@graficos')->name('grafico'); //Descarga el archivo
Route::get('/ventas/agrupado', 'VentasController@productosAgrupados')->name('agrupados'); //Descarga el archivo
Route::get('/ventas/compras', 'VentasController@MisCompras')->name('ventas.compras'); 
Route::get('/ventas/detalle/{id}', 'VentasController@Detalle')->name('ventas.detalle'); 
Route::get('/ventas/elegir/{maquina_id}/{producto_id}', 'VentasController@elegir')->name('ventas.elegir'); 


//Inventario de máquinas (Stock y máquinas)
Route::get('/stock/maquinas', 'MaquinasController@AllMaquinas')->name('maquinas.todas'); 
Route::get('/stock/detalle/{id}', 'MaquinasController@detalle')->name('maquinas.detalle'); 






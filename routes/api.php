<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//GET es recibir,tomar,obtener
//Post es escribir, guardar un estado videojuego


//Rutas API
Route::get('/test_cadena','ApiController@objeto_cadena');
Route::get('/test_objeto','ApiController@cadena_objeto');
Route::post('/guardar_estado','ApiController@guardar_estado');
Route::post('/guardar_monedas','ApiController@guardar_monedas');
Route::post('/obtener_estado','ApiController@obtener_estado');
Route::post('/obtener_monedas','ApiController@obtener_monedas');
Route::post('/crear_orden','ApiController@crear_orden');
Route::post('/login','ApiController@login')->name('login.api');
Route::post('/obtener_scores','ApiController@obtener_scores');
Route::post('/procesar_pago','PaymentController@procesar_pago');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

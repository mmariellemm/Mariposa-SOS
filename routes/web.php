<?php

//use Illuminate\Routing\Route;

//Route::get('/autores', function(){
//    dd('algo');
//});


// Rutas para Personajes

use App\Model\Jugador;
//facker
Route::get('/dbup/jugador','DbUpController@crear_jugadores');
Route::get('/dbup/orden','DbUpController@crear_ordenes');

Route::group(['middleware' => 'auth'], function() {


    //-----------------rutas del dashboard------------------

    Route::post('/dashboard/ventas_productos', 'DashboardController@dame_ventas_mes');
    Route::post('/dashboard/ventas_canal', 'DashboardController@dame_ventas_canal');
    Route::post('/dashboard/totales_genero', 'DashboardController@dame_total_genero');
    Route::post('/dashboard/totales_edades', 'DashboardController@dame_total_edad');
    Route::get('/dashboard', 'DashboardController@index')->name('index_venta');
 //--------

    //Valida si inicio sesion


    // Listado
Route::get('/personaje/listado', 'PersonajeController@listado')->name('index_personaje')-> middleware('candado2:PERS');
Route::get('/monstruo/listado', 'MonstruoController@listado')->name('index_monstruo')-> middleware('candado2:MONS');
Route::get('/tesoro/listado', 'TesoroController@listado')->name('index_tesoro')-> middleware('candado2:TESO');
Route::get('/skin/listado', 'SkinController@listado')->name('index_skin')-> middleware('candado2:SKIN');
Route::get('/jugador/listado', 'JugadorController@listado')->name('index_jugador')-> middleware('candado2:JUGA');
Route::get('/sala/listado', 'SalaController@listado')->name('index_sala');
Route::get('/usuario/listado', 'UsuarioController@listado')->name('index_usuario')-> middleware('candado2:USUA');
Route::get('/rol/listado','RolController@listado')->name('index_rol') -> middleware('candado2:ROL');

Route::get('/tienda/listado', 'TiendaController@listado')->name('index_venta')-> middleware('candado2:VENT');
    
Route::get('/jugador/pagar','PaymentController@formulario');
    

// Formulario (Puede manejar solicitudes GET y POST)

    //Personaje
Route::match(['get', 'post'], '/personaje/formulario/{id?}','PersonajeController@formulario')-> middleware('candado2:PERS');
    //Monstruo
Route::match(['get', 'post'], '/monstruo/formulario/{id?}','MonstruoController@formulario')-> middleware('candado2:MONS');
    //Tesoro
Route::match(['get', 'post'], '/tesoro/formulario/{id?}','TesoroController@formulario')-> middleware('candado2:TESO');
    //Skin
Route::match(['get', 'post'], '/skin/formulario/{id?}','SkinController@formulario')->middleware('candado2:SKIN');
    //Jugador
//Route::match(['get', 'post'], '/jugador/formulario/{id?}','JugadorController@formulario')-> middleware('candado2:JUGA');
    //Jugador sin candado
    Route::match(['get', 'post'], '/jugador/formulario/{id?}','JugadorController@formulario');

     //Sala
Route::match(['get', 'post'], '/sala/formulario/{id?}','SalaController@formulario');
    //Buscador
Route::match(['get', 'post'], '/buscador','BuscadorController@inicio');
    //Usuario
    Route::match(['get', 'post'], '/usuario/formulario{id?}','UsuarioController@formulario')-> middleware('candado2:USUA');

    //Roles
    Route::match(array('GET','POST'),'/rol/formulario/{id?}','RolController@formulario')-> middleware('candado2:ROL');

    Route::get('/rolxpermiso/formulario/{id?}','RolxPermisoController@formulario');



// Operaciones (Maneja solicitudes POST)

    //Personaje
Route::post('/personaje/operacion', 'PersonajeController@operacion');

Route::get('/personaje/mostrar_imagen/{nombre_imagen}','PersonajeController@mostrar_imagen')->name('mostrar_imagen');

    //Monstruo
    Route::post('/monstruo/operacion', 'MonstruoController@operacion');

    Route::get('/monstruo/mostrar_foto/{nombre_imagen}','MonstruoController@mostrar_foto')->name('mostrar_foto');

     //Tesoro
    Route::post('/tesoro/operacion', 'TesoroController@operacion');

    Route::get('/tesoro/mostrar_foto/{nombre_imagen}','TesoroController@mostrar_foto')->name('mostrar_foto');

     //Skin
     Route::post('/skin/operacion', 'SkinController@operacion');

     Route::get('/skin/mostrar_foto/{nombre_imagen}','SkinController@mostrar_foto')->name('mostrar_foto');

    //Usuario foto
    Route::post('/usuario/operacion', 'UsuarioController@operacion');

    Route::get('/usuario/mostrar_foto/{nombre_imagen}','UsuarioController@mostrar_foto')->name('mostrar_foto');

    //Jugador
Route::post('/jugador/operacion', 'JugadorController@operacion');

Route::get('/jugador/mostrar_foto/{nombre_foto}','JugadorController@mostrar_foto')->name('mostrar_foto');

    //Sala
Route::post('/sala/operacion', 'SalaController@operacion');

    //Usuario
    Route::post('/usuario/operaciones', 'UsuarioController@operaciones');

    //Roles

    Route::post('/rol/save','RolController@save');

    Route::post('/rolxpermiso/save','RolxPermisoController@save');






//Prubas Admin y jugador
Route::get('home/admin','AdminController@home');
Route::get('perfil/jugador','JugadorController@home2') ;
Route::get('home/jugador','JugadorController@home');
Route::get('page/landing','LandingController@home');



//ruta para listar registros
Route::get('/personaje/listado','PersonajeController@listado')->name('index_personaje')->middleware('candado2:PERS');

//ruta para listar registros
Route::get('/monstruo/listado','MonstruoController@listado')->name('index_monstruo')->middleware('candado2:MONS');

//ruta para listar registros
Route::get('/tesoro/listado','TesoroController@listado')->name('index_tesoro')->middleware('candado2:TESO');


   //Modulos de salas
   Route::get('/jugador/partida/crear','JugadorController@crear_sala')->middleware('candado2:SALA');
   Route::post('/jugador/partida/save','JugadorController@guardar_partida')->middleware('candado2:SALA');
   Route::get('/jugador/partida/unir','JugadorController@unir_sala')->middleware('candado2:SALA');
   Route::get('/jugador/partida/unir','JugadorController@unir_partida')->middleware('candado2:SALA');
   Route::post('/jugador/partida/unir_save','JugadorController@unir_partida_save')->middleware('candado2:SALA');
   Route::get('/jugador/partida/iniciar/{id?}','JugadorController@iniciar_partida')->middleware('candado2:SALA');
   Route::get('/jugador/partida/unir_partida/{id?}','JugadorController@unir_partida_turno')->middleware('candado2:SALA');

   Route::post('/jugador/partida/turno','JugadorController@crear_turno')->middleware('candado2:SALA');
   Route::post('/jugador/partida/turno/tirar_dados','JugadorController@tirar_dados')->middleware('candado2:SALA');









    });



    Route::get('/landing/page','LandingController@regresar')->name('index');


    //Rutas auth
Route::get('/login','LoginController@login')->name('login');
Route::post('/login/iniciar','LoginController@iniciar_sesion');
Route::get('/logout','LoginController@logout')->name('logout');

//Route::get('/login','LoginController@login')->name('login');
//Route::post('/login/iniciar','LoginController@iniciar_sesion2');
//Route::get('/logout','LoginController@logout')->name('logout');






    //Rutas autoregistro
    Route::get('/jugador/autoregistro','JugadorController@formulario_autoregistro');
    Route::post('/jugador/registro/save','JugadorController@autoregistro');


    Route::get('/plantilla_ejemplo',function(){
        return view('ejemplo');
    });


    Route::get('/sinpermiso',function(){
        return view('sinpermiso');
    });


<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function()
{
    //------------------------------ Login -----------------------------------------------------
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    //------------------------------ Usuarios --------------------------------------------------
    Route::get('GetUsuarios', 'UserController@index');
    Route::post('CrearUsuario', 'UserController@CrearUsuario');
    Route::put('EliminarUsuario', 'UserController@EliminarUsuario');
    Route::post('ModificarUsuario', 'UserController@ModificarUsuario');
    //------------------------------ Roles -----------------------------------------------------
    Route::get('GetRoles', 'RolController@GetRoles');
    Route::post('CreateRol', 'RolController@CreateRol');
    Route::put('EliminarRol', 'RolController@EliminarRol');
    Route::post('ModificarRol', 'RolController@ModificarRol');
    //------------------------------ Productos -------------------------------------------------
    Route::post('CrearProducto', 'ProductoController@CrearProducto');
    Route::get('GetProductos', 'ProductoController@GetProductos');
    Route::put('EliminarProducto', 'ProductoController@EliminarProducto');
    Route::post('ModificarProducto', 'ProductoController@ModificarProducto');
});

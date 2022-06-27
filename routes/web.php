<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('hola', function () use ($router) {
    return "Hola Mundo, esta es mi primera API REST con Lumen-Laravell en PHP.";
});

//Rest Service que devuelve una lista de libros
$router->get('/libros', 'LibroController@index'); //Nombre_Controlador@Nombre_metodo

//Rest Service que guarda un libro
$router->post('/libros', 'LibroController@guardar');

//Rest Service para buscar un registro de libro especifico
$router->get('/libros/{idLibro}', 'LibroController@leer'); //usando un pathparam para enviar el id

//Rest Service para eliminar un registro de libro especifico
$router->delete('/libros/{idLibro}', 'LibroController@borrar'); //usando un pathparam para enviar el id

//Rest Service para actualizar un registro de libro especifico
$router->put('/libros/actualizar/{idLibro}', 'LibroController@actualizar');  //usando un pathparam para enviar el id

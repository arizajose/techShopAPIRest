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

//URIs para Categorias
$router->get('/categorias', 'CategoriaController@getCategorias');
$router->get('/categorias/{id}', 'CategoriaController@getCategoriaById');
$router->post('/categorias', 'CategoriaController@guardarCategoria');

//URIs para Productos
$router->get('/productos', 'ProductoController@getProductos');
$router->get('/productos/{id}', 'ProductoController@getProductoById');
$router->post('/productos', 'ProductoController@guardarProducto');
$router->delete('/productos/{id}', 'ProductoController@deleteProductoById');
$router->put('/productos/{id}', 'ProductoController@updateProductoById');

//URIs para PerfilSystem
$router->get('/perfilsystem', 'PerfilSystemController@getPerfilSystem');
$router->get('/perfilsystem/{id}', 'PerfilSystemController@getPerfilSystemById');
$router->post('/perfilsystem', 'PerfilSystemController@guardarPerfilSystem');

//URIs para Clientes
$router->get('/clientes', 'ClienteController@getClientes');
$router->get('/clientes/{id}', 'ClienteController@getClienteById');
$router->post('/clientes', 'ClienteController@guardarCliente');

//URIs para Empleados
$router->get('/empleados', 'EmpleadoController@getEmpleados');
$router->get('/empleados/{id}', 'EmpleadoController@getEmpleadoById');
$router->post('/empleados', 'EmpleadoController@guardarEmpleado');

//URIs para Comprobantes
$router->get('/comprobantes', 'ComprobanteController@getComprobantes');
$router->get('/comprobantes/{id}', 'ComprobanteController@getComprobanteById');
$router->post('/comprobantes', 'ComprobanteController@guardarComprobante');

//URIs para Ventas
$router->get('/ventas', 'VentaController@getVentas');
$router->get('/ventas/{id}', 'VentaController@getVentaById');
$router->get('/ventas-detalle', 'VentaController@getVentasDetalle');
$router->get('/ventas-detalle/{id}', 'VentaController@getVentaDetalleById');
$router->get('/ventas-detalle/grafico/{idyear}', 'VentaController@getVentaPorMes');
$router->post('/ventas', 'VentaController@guardarVenta');
$router->delete('/ventas/{id}', 'VentaController@deleteVentaById');
$router->put('/ventas/{id}', 'VentaController@updateVentaById');

//URIs para DetalleVentas
$router->get('/detalleventas/{id}', 'DetalleVentaController@getDetalleVentaByVentaId');
$router->post('/detalleventas', 'DetalleVentaController@guardarDetalleVenta');

//URIs para Boletas
$router->get('/boletas', 'BoletaController@getBoletas');
$router->get('/boletas/{id}', 'BoletaController@getBoletaById');
$router->post('/boletas', 'BoletaController@guardarBoleta');
$router->delete('/boletas/{id}', 'BoletaController@deleteBoletaById');
$router->put('/boletas/{id}', 'BoletaController@updateBoletaById');

//URIs para Facturas
$router->get('/facturas', 'FacturaController@getFacturas');
$router->get('/facturas/{id}', 'FacturaController@getFacturaById');
$router->post('/facturas', 'FacturaController@guardarFactura');
$router->delete('/facturas/{id}', 'FacturaController@deleteFacturaById');
$router->put('/facturas/{id}', 'FacturaController@updateFacturaById');

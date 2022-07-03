<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Str;

class ProductoController extends Controller
{

    //Lista de Productos
    public function getProductos()
    {
        $productos = Producto::all();

        return response()->json($productos);
    }

    //Producto por id
    public function getProductoById($id)
    {
        $producto = Producto::find($id);

        return response()->json($producto);
    }
    //Guardar producto
    public function guardarProducto(Request $request)
    {
        $producto = new Producto();
        $producto->producto_id = ProductoController::productId();
        $producto->producto_nombre = $request->producto_nombre;
        $producto->producto_descripcion = $request->producto_descripcion;
        $producto->producto_categoria = $request->producto_categoria;
        $producto->producto_precio_compra = $request->producto_precio_compra;
        $producto->producto_precio_venta = $request->producto_precio_venta;
        $producto->producto_stock = $request->producto_stock;
        $producto->producto_fecha_registro = $request->producto_fecha_registro;
        $producto->producto_imagen = $request->producto_imagen;
        $producto->save();

        $msm = "Producto registrado.";
        return response()->json($msm);
    }
    //Eliminar producto
    public function deleteProductoById($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            $msm = "Producto eliminado.";
            return response()->json($msm);
        } else {
            $msm = "Producto no registrado en el sistema.";
            return response()->json($msm);
        }
    }
    //Modificar producto
    public function updateProductoById(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->producto_nombre = $request->input('producto_nombre');
        $producto->producto_descripcion = $request->input('producto_descripcion');
        $producto->producto_categoria = $request->input('producto_categoria');
        $producto->producto_precio_compra = $request->input('producto_precio_compra');
        $producto->producto_precio_venta = $request->input('producto_precio_venta');
        $producto->producto_stock = $request->input('producto_stock');
        $producto->producto_fecha_registro = $request->input('producto_fecha_registro');
        $producto->producto_imagen = $request->input('producto_imagen');

        $producto->save();
        return response()->json($producto);
    }

    //Id de producto: cadena alfanumerica aleatoria de 5 caracteres única.
    public function productId()
    {
        $cod = '';
        do {
            $generator = Str::random(5);
            $producto = Producto::find($generator);
            $cod = $generator;
        } while ($producto != null);


        return $cod;
    }
}

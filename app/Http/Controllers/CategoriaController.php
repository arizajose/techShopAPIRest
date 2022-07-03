<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{

    //Lista de categorias
    public function getCategorias()
    {
        $categorias = Categoria::all();

        return response()->json($categorias);
    }

    //Categoria por id
    public function getCategoriaById($id)
    {
        $categoria = Categoria::find($id);

        return response()->json($categoria);
    }

    //Guardar categoria
    public function guardarCategoria(Request $request)
    {
        $categoria = new Categoria();
        $categoria->categoria_nombre = $request->categoria_nombre;
        $categoria->categoria_imagen = $request->categoria_imagen;
        $categoria->save();

        $msm = "Categoria registrada.";
        return response()->json($msm);
    }
}

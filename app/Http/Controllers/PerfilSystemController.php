<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilSystem;

class PerfilSystemController extends Controller
{

    //Lista de PerfilSystem
    public function getPerfilSystem()
    {

        $perfilsystem = PerfilSystem::all();

        return response()->json($perfilsystem);
    }

    //PerfilSystem por id
    public function getPerfilSystemById($id)
    {

        $perfilsystem = PerfilSystem::find($id);

        return response()->json($perfilsystem);
    }

    //Guardar PerfilSystem
    public function guardarPerfilSystem(Request $request)
    {

        $perfilsystem = new PerfilSystem();

        $perfilsystem->perfilsystem_nombre = $request->perfilsystem_nombre;
        $perfilsystem->perfilsystem_descripcion = $request->perfilsystem_descripcion;
        $perfilsystem->perfilsystem_estado = $request->perfilsystem_estado;

        $perfilsystem->save();

        $msm = "Producto registrado.";
        return response()->json($msm);
    }
}

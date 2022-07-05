<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{

    //Listado de Empleados
    public function getEmpleados()
    {
        $empleados = Empleado::all();

        return response()->json($empleados);
    }

    //Empleado por id
    public function getEmpleadoById($id)
    {
        $empleado = Empleado::find($id);

        return response()->json($empleado);
    }

    //Guardar Empleado
    public function guardarEmpleado(Request $request)
    {
        //Para el primer registro: C0001
        /*  $empleados = Empleado::all();
     $json = json_decode($empleados, true);
     $cantidad = count($json);
     if ($cantidad <= 0) { */
        $empleado = new Empleado();
        //$empleado->empleado_id  = 'E0001';
        $empleado->empleado_dni = $request->empleado_dni;
        $empleado->empleado_nombre = $request->empleado_nombre;
        $empleado->empleado_apellido = $request->empleado_apellido;
        $empleado->empleado_direccion = $request->empleado_direccion;
        $empleado->empleado_telefono = $request->empleado_telefono;
        $empleado->empleado_email = $request->empleado_email;
        $empleado->empleado_fecha_registro = $request->empleado_fecha_registro;
        $empleado->empleado_usser = $request->empleado_usser;
        $empleado->empleado_password = $request->empleado_password;
        $empleado->empleado_estado = $request->empleado_estado;
        $empleado->empleado_perfil  = $request->empleado_perfil;
        $empleado->save();
        /*  } else {
         //Llamando al procedimiento almacenado
         $now = Carbon::now();
         DB::select('call myStoredProcedure_grabarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
             $request->empleado_dni,
             $request->empleado_nombre,
             $request->empleado_apellido,
             $request->empleado_direccion,
             $request->empleado_telefono,
             $request->empleado_email,
             $request->empleado_fecha_registro,
             $request->empleado_usser,
             $request->empleado_password,
             $request->empleado_estado,
             $request->empleado_perfil,
             $now,
             $now
         ));
     } */
        $msm = "Empleado registrado.";
        return response()->json($msm);
    }
}

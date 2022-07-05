<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    //Listado de Clientes
    public function getClientes()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }

    //Cliente por id
    public function getClienteById($id)
    {
        $cliente = Cliente::find($id);

        return response()->json($cliente);
    }

    //Guardar Cliente
    public function guardarCliente(Request $request)
    {
        //Para el primer registro: C0001
        $clientes = Cliente::all();
        $json = json_decode($clientes, true);
        $cantidad = count($json);
        if ($cantidad <= 0) {
            $cliente = new Cliente();
            $cliente->cliente_id  = 'C0001';
            $cliente->cliente_dni = $request->cliente_dni;
            $cliente->cliente_nombre = $request->cliente_nombre;
            $cliente->cliente_apellido = $request->cliente_apellido;
            $cliente->cliente_direccion = $request->cliente_direccion;
            $cliente->cliente_telefono = $request->cliente_telefono;
            $cliente->cliente_email = $request->cliente_email;
            $cliente->cliente_fecha_registro = $request->cliente_fecha_registro;
            $cliente->cliente_usser = $request->cliente_usser;
            $cliente->cliente_password = $request->cliente_password;
            $cliente->cliente_estado = $request->cliente_estado;
            $cliente->cliente_perfil  = $request->cliente_perfil;
            $cliente->save();
        } else {
            //Llamando al procedimiento almacenado
            $now = Carbon::now();
            DB::select('call myStoredProcedure_grabarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?)', array(
                $request->cliente_dni,
                $request->cliente_nombre,
                $request->cliente_apellido,
                $request->cliente_direccion,
                $request->cliente_telefono,
                $request->cliente_email,
                $request->cliente_fecha_registro,
                $request->cliente_usser,
                $request->cliente_password,
                $request->cliente_estado,
                $request->cliente_perfil,
                $now,
                $now
            ));
        }
        $msm = "Cliente registrado.";
        return response()->json($msm);
    }

    //Eliminar Cliente

    //Modificar Cliente

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class VentaController extends Controller
{
    //Lista de Ventas
    public function getVentas()
    {
        $ventas = Venta::all();
        return response()->json($ventas);
    }
    //Venta por id
    public function getVentaById($id)
    {
        $venta = Venta::find($id);
        return response()->json($venta);
    }
    //Lista de ventas-detalle
    public function getVentasDetalle()
    {
        $ventas = Venta::all();
        $arrayVentasDetalle = array();
        foreach ($ventas as $venta) {
            $detalles = DetalleVenta::join(
                'productos',
                'productos.producto_id',
                '=',
                'detalleventas.detalleventa_producto'
            )
                ->where('detalleventa_venta', '=', $venta->venta_id)->get();

            $detalleVentaResponse = array();

            foreach ($detalles as $detalle) {
                $detalleresponse = array(
                    "producto" => $detalle->producto_nombre,
                    "precio" => $detalle->producto_precio_venta,
                    "cantidad" => $detalle->detalleventa_cantidad,
                    "subtotal" => ($detalle->producto_precio_venta * $detalle->detalleventa_cantidad)
                );
                array_push($detalleVentaResponse, $detalleresponse);
            }

            $ventaresponse = array(
                "cliente" => $venta->venta_cliente,
                "comprobante" => $venta->venta_tipo_comprobante,
                "detalle" => $detalleVentaResponse
            );
            +array_push($arrayVentasDetalle, $ventaresponse);
        }
        return response()->json($arrayVentasDetalle);
    }

    //Venta-detalle por id
    public function getVentaDetalleById($id)
    {

        $venta = Venta::find($id);
        $detalles = DetalleVenta::join(
            'productos',
            'productos.producto_id',
            '=',
            'detalleventas.detalleventa_producto'
        )
            ->where('detalleventa_venta', '=', $id)->get();

        $detalleVentaResponse = array();

        foreach ($detalles as $detalle) {
            $detalleresponse = array(
                "producto" => $detalle->producto_nombre,
                "precio" => $detalle->producto_precio_venta,
                "cantidad" => $detalle->detalleventa_cantidad,
                "subtotal" => ($detalle->producto_precio_venta * $detalle->detalleventa_cantidad)
            );
            array_push($detalleVentaResponse, $detalleresponse);
        }

        $ventaresponse = array(
            "cliente" => $venta->venta_cliente,
            "comprobante" => $venta->venta_tipo_comprobante,
            "detalle" => $detalleVentaResponse
        );

        return response()->json($ventaresponse);
    }

    //Guardar Venta
    public function guardarVenta(Request $request)
    {
        //Para el primer registro: A0001
        $venta = Venta::all();
        $json = json_decode($venta, true);
        $cantidad = count($json);
        if ($cantidad <= 0) {
            $venta = new Venta();
            $venta->venta_id = 'F0001';
            $venta->venta_fecha_emitida = $request->venta_fecha_emitida;
            $venta->venta_hora_emitida = $request->venta_hora_emitida;
            $venta->venta_igv = $request->venta_igv;
            $venta->venta_cliente  = $request->venta_cliente;
            $venta->venta_empleado  = $request->venta_empleado;
            $venta->venta_tipo_comprobante  = $request->venta_tipo_comprobante;
            $venta->save();
        } else {
            //Llamando al procedimiento almacenado
            $now = Carbon::now();
            DB::select('call myStoredProcedure_grabarVenta(?,?,?,?,?,?,?,?)', array(
                $request->venta_cliente,
                $request->venta_fecha_emitida,
                $request->venta_hora_emitida,
                $request->venta_igv,
                $request->venta_empleado,
                $request->venta_tipo_comprobante,
                $now,
                $now
            ));
        }

        $msm = "Venta registrada.";
        return response()->json($msm);
    }

    //Eliminar Venta
    public function deleteVentaById($id)
    {
        $venta = Venta::find($id);
        if ($venta) {
            $venta->delete();
            $msm = "Venta eliminada.";
            return response()->json($msm);
        } else {
            $msm = "Venta no registrada en el sistema.";
            return response()->json($msm);
        }
    }

    //Modificar Venta
    public function updateVentaById(Request $request, $id)
    {
        $venta = Venta::find($id);
        $venta->venta_fecha_emitida = $request->input('venta_fecha_emitida');
        $venta->venta_hora_emitida = $request->input('venta_hora_emitida');
        $venta->venta_igv = $request->input('venta_igv');
        $venta->venta_cliente = $request->input('venta_cliente');
        $venta->venta_empleado = $request->input('venta_empleado');
        $venta->venta_tipo_comprobante = $request->input('venta_tipo_comprobante');
        $venta->save();

        $msm = "Venta Modificada.";
        return response()->json($msm);
    }

    //Venta por Mes
    public function getVentaPorMes($idyear)
    {
        $data = DB::select('call myStoredProcedure_ObtenerVentasPorMes(?)', array($idyear));
        $json = json_encode($data, true);
        $array = json_decode($json,true);

        return response()->json($array);
    }
}

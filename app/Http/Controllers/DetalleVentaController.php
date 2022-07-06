<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DetalleVentaController extends Controller{

    //Lista de Detalle

    //Detalle por Venta id
    public function getDetalleVentaByVentaId($id)
    {
        $detalles = DB::select('select * from detalleventas where detalleventa_venta  = ?', [$id]);

        return response()->json($detalles);
    }
    //Guardar Detalle(json array)
    public function guardarDetalleVenta(Request $request)
    {
        $arrayRequest = json_decode($request->getContent(),true);
        foreach ($arrayRequest as $detalle) {
            $now = Carbon::now();
            DB::select('call myStoredProcedure_grabarDetalleVenta(?,?,?,?,?)', array(
                $detalle['detalleventa_venta'],
                $detalle['detalleventa_producto'],
                $detalle['detalleventa_cantidad'],
                $now,
                $now
            ));
        }
        $msm = "Detalle de la Venta registrada.";
        return response()->json($msm);
    }

}

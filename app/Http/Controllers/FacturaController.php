<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;

class FacturaController extends Controller
{

    //Lista de Factura
    public function getFacturas()
    {
        $facturas = Factura::all();
        return response()->json($facturas);
    }
    //Factura por id
    public function getFacturaById($id)
    {
        $factura = Factura::find($id);
        return response()->json($factura);
    }
    //Guardar Factura
    public function guardarFactura(Request $request)
    {
        $factura = new Factura();
        $factura->factura_venta = $request->factura_venta;
        $factura->factura_subtotal = $request->factura_subtotal;
        $factura->factura_igv  = $request->factura_igv;
        $factura->factura_total  = $request->factura_total;
        $factura->tipo_comprobante   = $request->tipo_comprobante;
        $factura->save();

        $msm = "Factura Registrada.";
        return response()->json($msm);
    }
    //Eliminar Factura
    public function deleteFacturaById($id)
    {
        $factura = Factura::find($id);
        if ($factura) {
            $factura->delete();
            $msm = "Factura eliminada.";
            return response()->json($msm);
        } else {
            $msm = "Factura no registrada en el sistema.";
            return response()->json($msm);
        }
    }

    //Modificar Factura
    public function updateFacturaById(Request $request, $id)
    {
        $factura = Factura::find($id);
        $factura->factura_venta = $request->input('factura_venta');
        $factura->factura_subtotal = $request->input('factura_subtotal');
        $factura->factura_igv  = $request->input('factura_igv');
        $factura->factura_total  = $request->input('factura_total');
        $factura->tipo_comprobante   = $request->input('tipo_comprobante');
        $factura->save();

        $msm = "Factura Modificada.";
        return response()->json($msm);
    }
}

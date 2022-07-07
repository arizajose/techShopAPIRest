<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boleta;

class BoletaController extends Controller
{

    //Lista de Boletas
    public function getBoletas()
    {
        $boletas = Boleta::all();
        return response()->json($boletas);
    }
    //Boleta por id
    public function getBoletaById($id)
    {
        $boleta = Boleta::find($id);
        return response()->json($boleta);
    }
    //Guardar Boleta
    public function guardarBoleta(Request $request)
    {
        $boleta = new Boleta();
        $boleta->boleta_venta  = $request->boleta_venta;
        $boleta->boleta_total = $request->boleta_total;
        $boleta->tipo_comprobante  = $request->tipo_comprobante;
        $boleta->save();

        $msm = "Boleta Registrada.";
        return response()->json($msm);
    }

    //Eliminar Boleta
    public function deleteBoletaById($id)
    {
        $boleta = Boleta::find($id);
        if ($boleta) {
            $boleta->delete();
            $msm = "Boleta eliminada.";
            return response()->json($msm);
        } else {
            $msm = "Boleta no registrada en el sistema.";
            return response()->json($msm);
        }
    }

    //Modificar Boleta
    public function updateBoletaById(Request $request, $id)
    {
        $boleta = Boleta::find($id);
        $boleta->boleta_venta = $request->input('boleta_venta');
        $boleta->boleta_total = $request->input('boleta_total');
        $boleta->tipo_comprobante = $request->input('tipo_comprobante');
        $boleta->save();

        $msm = "Boleta Modificada.";
        return response()->json($msm);
    }
}

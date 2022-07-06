<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprobante;

class ComprobanteController extends Controller{

    //Lista de Comprobantes
    public function getComprobantes()
    {
        $comprobantes = Comprobante::all();

        return response()->json($comprobantes);
    }
    //Comprobante por id
    public function getComprobanteById($id)
    {
        $comprobante = Comprobante::find($id);

        return response()->json($comprobante);
    }
    //Guardar Comprobante
    public function guardarComprobante(Request $request)
    {
        $comprobante = new Comprobante();
        $comprobante->comprobante_tipo = $request->comprobante_tipo;
        $comprobante->save();

        $msm = "Comrpobante registrado.";
        return response()->json($msm);
    }
}

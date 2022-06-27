<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Carbon\Carbon; //para el tiempo

class LibroController extends Controller
{

    //Ejemplo de consulta
    public function index()
    {
        $datosLibro = Libro::all(); //Trae todos los registros de la tabla libros
        //la cual esta referenciada al model Libro. all() es un método de Eloquent.

        return response()->json($datosLibro); //Envía como respuesta el listado de registro
        //de libros en formato JSON.
    }

    //Guardar libro
    public function guardar(Request $request)
    {
        //nuevo objeto Libro a guardar en la base de datos
        $datosLibro = new Libro();
        //guardando los atributos del objeto
        //adjuntar archivo
        if ($request->hasFile('imagen')) {
            //1. nombre originar del archivo (incluido extension)
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            //2. tiempo en formato numerico_nombre original
            $nombreAdjuntoBD = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;
            //3. repositorio de imagenes contenido en la carpeta public
            $carpetaDestino = './upload/';
            //4. para recepcionar archivos
            $request->file('imagen')->move($carpetaDestino, $nombreAdjuntoBD);
            //columnas de la tabla | datos enviados en la URI
            //1. guardando el titulo del libro en el campo "titulo"
            $datosLibro->titulo = $request->titulo;
            //2. guardando la direccion del archivo en el proyecto en el campo "imagen"
            $datosLibro->imagen = ltrim($carpetaDestino, ".") . $nombreAdjuntoBD;
            //3. método para guardar
            $datosLibro->save();
        }

        //response: lo que envia como respuesta el servicio
        //return response() -> json($datosLibro);
        // return response()->json($datosLibro);
        $msm = "Registro guardado.";
        return response()->json($msm);
    }

    //Consultar libro
    public function leer($idLibro)
    {
        //nuevo objeto libro a consultar en la base de datos
        $datosLibro = new Libro();
        //método de busqueda (con instanciacion)
        $datosEncontrados = $datosLibro->find($idLibro);
        //response: lo que envia como respuesta el servicio
        return response()->json($datosEncontrados);
    }

    //Eliminar libro
    public function borrar($idLibro)
    {
        //método de busqueda (uso directo)
        $datosEncontrados = Libro::find($idLibro);
        //consultar
        if ($datosEncontrados) { // si registro existe
            $rutaArchivo = base_path('public') . $datosEncontrados->imagen; //ruta del archivo en el proyecto
            if (file_exists($rutaArchivo)) { // si archivo existe
                unlink($rutaArchivo); //elimina el archivo si la ruta esta en el registro del libro en la bd
            }
            $datosEncontrados->delete(); //elimina registro del libro

        }
        //response: lo que envia como respuesta el servicio
        $msm = "Registro borrado.";
        return response()->json($msm);
    }

    //Actualizar libro
    public function actualizar(Request $request, $idLibro)
    {
        //método de busqueda (uso directo)
        $datosLibro = Libro::find($idLibro);

        //modificando la imagen
        if ($request->hasFile('imagen')) {
            //antes de borra la imagen anterior
            if ($datosLibro) { // si registro existe
                $rutaArchivo = base_path('public') . $datosLibro->imagen; //ruta del archivo en el proyecto
                if (file_exists($rutaArchivo)) { // si archivo existe
                    unlink($rutaArchivo); //elimina el archivo si la ruta esta en el registro del libro en la bd
                }
                $datosLibro->delete(); //elimina registro del libro
            }

            //1. nombre originar del archivo (incluido extension)
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            //2. tiempo en formato numerico_nombre original
            $nombreAdjuntoBD = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;
            //3. repositorio de imagenes contenido en la carpeta public
            $carpetaDestino = './upload/';
            //4. para recepcionar archivos
            $request->file('imagen')->move($carpetaDestino, $nombreAdjuntoBD);
            //columnas de la tabla | datos enviados en la URI
            //1. guardando el titulo del libro en el campo "titulo"
            //$datosLibro->titulo = $request->titulo;
            //2. guardando la direccion del archivo en el proyecto en el campo "imagen"
            $datosLibro->imagen = ltrim($carpetaDestino, ".") . $nombreAdjuntoBD;
            //3. método para guardar
            // $datosLibro->save();
        }
        //modificando el titulo
        if ($request->input('titulo')) {
            $datosLibro->titulo = $request->input('titulo');
        }
        //guardando las modificaciones
        $datosLibro->save();
        //response: lo que envia como respuesta el servicio
        //$msm = "Registro actualizado.";
        return response()->json($datosLibro);
    }
}

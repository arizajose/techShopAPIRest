<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use function PHPUnit\Framework\assertTrue;

class CategoriaUnitTest extends TestCase
{

    //Probando GetList Categoria (Ejemplo de Prueba Unitaria)
    public function test_getCategorias_response_status()
    {
        $restService = 'https://techshopapirest.herokuapp.com/categorias';
        $restServiceMethod = 'GET';
        $condition = false;
        $response = $this->call($restServiceMethod, $restService); //llamando al servicio REST

        $status = array(
            "cod" => $response->status(),
            "message" => $response->statusText()
        );
        $statusJson = json_encode($status);
        $bodyJson = json_encode($response);
        print("\n");
        print("test_getCategorias_response_status()\n");
        print("status: " . $statusJson . "\n");
        print("response: " . $bodyJson . "\n");
        if ($status["cod"] == "200") {
            $condition = true;
            print("resultado: !Prueba exitosa!\n");
        }
        //Método assert
        $this->assertTrue($condition, 'Error en consulta: ' . $status["message"]);
    }
}

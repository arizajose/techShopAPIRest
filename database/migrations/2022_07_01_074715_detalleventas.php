<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleventas', function (Blueprint $table) {
            //$table->id();
            $table->char("detalleventa_venta", 5)->collation("utf8mb4_general_ci"); //FK
            $table->char("detalleventa_producto", 5)->collation("utf8mb4_general_ci"); //FK
            $table->integer("detalleventa_cantidad");
            $table->timestamps();
            //Configurando PK y FK
            $table->foreign("detalleventa_venta")->references("venta_id")->on("ventas")->onDelete("cascade");
            $table->foreign("detalleventa_producto")->references("producto_id")->on("productos")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleventas');
    }
};

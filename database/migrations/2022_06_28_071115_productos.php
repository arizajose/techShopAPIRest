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
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char("producto_id", 5)->collation("utf8mb4_general_ci");
            //$table->id("producto_id"); usar si la PK es de tipo INT
            $table->string("producto_nombre", 30)->collation("utf8_spanish_ci");
            $table->string("producto_descripcion", 100)->collation("utf8_spanish_ci");
            $table->bigInteger("producto_categoria")->unsigned();
            $table->decimal("producto_precio_compra", 10, 2);
            $table->decimal("producto_precio_venta", 10, 2);
            $table->integer("producto_stock");
            $table->date("producto_fecha_registro");
            $table->string("producto_imagen", 30)->collation("utf8mb4_general_ci");
            $table->timestamps();
            //Configurando PK y FK
            $table->primary("producto_id"); //desactivar si la PK es de tipo INT
            //relacionando con la tabla categoria y el borrrado en cascada para evitar conflictos
            $table->foreign("producto_categoria")->references("categoria_id")->on("categorias")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};

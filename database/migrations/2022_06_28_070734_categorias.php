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
        Schema::create('categorias', function (Blueprint $table) {
            //habilitando el borrado/modificación en cascada
            $table->engine = "InnoDB";
            //campos de la tabla
            $table->id("categoria_id");
            $table->string("categoria_nombre", 35)->collation("utf8_spanish_ci");
            $table->string("categoria_imagen", 30)->collation("utf8mb4_general_ci");
            //tiempos de creación/modificación del registro en la tabla
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};

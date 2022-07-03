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
        Schema::create('boletas', function (Blueprint $table) {
            $table->id("boleta_id");
            $table->char("boleta_venta", 5)->collation("utf8mb4_general_ci");
            $table->decimal("boleta_total", 10, 2);
            $table->bigInteger("tipo_comprobante")->unsigned();
            $table->timestamps();
            //Configurando PK y FK
            $table->foreign("boleta_venta")->references("venta_id")->on("ventas")->onDelete("cascade");
            $table->foreign("tipo_comprobante")->references("comprobante_id")->on("comprobantes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletas');
    }
};

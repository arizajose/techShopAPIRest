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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id("factura_id");
            $table->char("factura_venta", 5)->collation("utf8mb4_general_ci");
            $table->decimal("factura_subtotal", 10, 2);
            $table->decimal("factura_igv", 10, 2);
            $table->decimal("factura_total", 10, 2);
            $table->bigInteger("tipo_comprobante")->unsigned();
            $table->timestamps();
            //Configurando PK y FK
            $table->foreign("factura_venta")->references("venta_id")->on("ventas")->onDelete("cascade");
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
        Schema::dropIfExists('facturas');
    }
};

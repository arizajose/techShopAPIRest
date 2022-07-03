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
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char("venta_id", 5)->collation("utf8mb4_general_ci");
            $table->date("venta_fecha_emitida");
            $table->time("venta_hora_emitida");
            $table->char("venta_igv", 5)->collation("utf8mb4_general_ci");
            $table->char("venta_cliente", 5)->collation("utf8mb4_general_ci"); //FK
            $table->bigInteger("venta_empleado")->unsigned(); //FK
            $table->bigInteger("venta_tipo_comprobante")->unsigned(); //FK
            $table->timestamps();
            //Configurando PK y FK
            $table->primary("venta_id");
            $table->foreign("venta_cliente")->references("cliente_id")->on("clientes")->onDelete("cascade");
            $table->foreign("venta_empleado")->references("empleado_id")->on("empleados")->onDelete("cascade");
            $table->foreign("venta_tipo_comprobante")->references("comprobante_id")->on("comprobantes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};

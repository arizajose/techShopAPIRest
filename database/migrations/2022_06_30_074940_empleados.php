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
        Schema::create('empleados', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id("empleado_id");
            $table->string("empleado_dni", 8)->collation("utf8mb4_general_ci");
            $table->string("empleado_nombre", 25)->collation("utf8_spanish_ci");
            $table->string("empleado_apellido", 30)->collation("utf8_spanish_ci");
            $table->string("empleado_direccion", 45)->collation("utf8_spanish_ci");
            $table->string("empleado_telefono", 9)->collation("utf8_spanish_ci");
            $table->string("empleado_email", 30)->collation("utf8_spanish_ci");
            $table->date("empleado_fecha_registro");
            $table->string("empleado_usser", 30)->collation("utf8_spanish_ci");
            $table->string("empleado_password", 30)->collation("utf8_spanish_ci");
            $table->boolean("empleado_estado");
            $table->bigInteger("empleado_perfil")->unsigned();
            $table->timestamps();
            //Configurando PK y FK
            $table->foreign("empleado_perfil")->references("perfilsystem_id")->on("perfilsystem")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};

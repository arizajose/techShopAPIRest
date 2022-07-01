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
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->char("cliente_id", 5)->collation("utf8mb4_general_ci");
            $table->string("cliente_dni", 8)->collation("utf8mb4_general_ci");
            $table->string("cliente_nombre", 25)->collation("utf8_spanish_ci");
            $table->string("cliente_apellido", 30)->collation("utf8_spanish_ci");
            $table->string("cliente_direccion", 45)->collation("utf8_spanish_ci");
            $table->string("cliente_telefono", 9)->collation("utf8_spanish_ci");
            $table->string("cliente_email", 30)->collation("utf8_spanish_ci");
            $table->date("cliente_fecha_registro");
            $table->string("cliente_usser", 30)->collation("utf8_spanish_ci");
            $table->string("cliente_password", 30)->collation("utf8_spanish_ci");
            $table->boolean("cliente_estado");
            $table->bigInteger("cliente_perfil")->unsigned();
            $table->timestamps();
            //Configurando PK y FK
            $table->primary("cliente_id");
            $table->foreign("cliente_perfil")->references("perfilsystem_id")->on("perfilsystem")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};

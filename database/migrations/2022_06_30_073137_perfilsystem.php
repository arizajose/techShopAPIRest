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
        Schema::create('perfilsystem', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id("perfilsystem_id");
            $table->string("perfilsystem_nombre", 15)->collation("utf8_spanish_ci");
            $table->string("perfilsystem_descripcion", 50)->collation("utf8_spanish_ci");
            $table->boolean("perfilsystem_estado");
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
        Schema::dropIfExists('perfilsystem');
    }
};

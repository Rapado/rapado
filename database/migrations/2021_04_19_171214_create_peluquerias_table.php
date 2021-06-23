<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeluqueriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peluquerias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre');
            $table->bigInteger('telefono');
            $table->string('nombreEncargado')->nullable();
            $table->string('documento')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('activa')->default(false);
            $table->string('direccion')->nullable();
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
        Schema::dropIfExists('servicios');
        Schema::dropIfExists('peluqueria_estados');
        Schema::dropIfExists('peluqueria_favoritas');
        Schema::dropIfExists('peluqueria_evaluaciones');
        Schema::dropIfExists('dia_de_trabajos');
        Schema::dropIfExists('peluqueros');
        Schema::dropIfExists('peluquerias');
    }
}

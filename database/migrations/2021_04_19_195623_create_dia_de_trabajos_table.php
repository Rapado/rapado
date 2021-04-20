<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaDeTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_de_trabajos', function (Blueprint $table) {
            $table->id();
            $table->enum('dia', [1, 2, 3, 4, 5, 6, 7]);
            $table->time('apertura');
            $table->time('cierre');
            $table->time('horaDescansoInicio')->nullable();
            $table->time('horaDescansoFinaliza')->nullable();
            $table->foreignId('peluqueria_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dia_de_trabajos');
    }
}

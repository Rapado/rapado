<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeluqueriaEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peluqueria_estados', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ['enRevision', 'aceptada', 'rechazada', 'reenviarDoc']);
            $table->foreignId('administrador_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('peluqueria_estados');
    }
}

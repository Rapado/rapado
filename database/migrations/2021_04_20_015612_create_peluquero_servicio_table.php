<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeluqueroServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peluquero_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('peluquero_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('peluquero_servicio');
    }
}

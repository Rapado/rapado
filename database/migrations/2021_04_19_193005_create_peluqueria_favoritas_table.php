<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeluqueriaFavoritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peluqueria_favoritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('peluqueria_favoritas');
    }
}

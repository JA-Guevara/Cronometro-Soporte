<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroTiemposTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registro_tiempos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operador_id');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final')->nullable();
            $table->time('tiempo_transcurrido')->nullable();
            $table->timestamps();

            $table->foreign('operador_id')->references('id')->on('operador')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_tiempos');
    }
}

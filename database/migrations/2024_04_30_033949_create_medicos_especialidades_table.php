<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medicos_especialidades', function (Blueprint $table) {
            $table->bigInteger('medicos_id')->unsigned()->nullable();
            $table->foreign('medicos_id')->references('id')->on('medicos')
                ->onDelete('cascade');

            $table->bigInteger('especialidades_id')->unsigned()->nullable();
            $table->foreign('especialidades_id')->references('id')->on('especialidades')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos_especialidades');
    }
};

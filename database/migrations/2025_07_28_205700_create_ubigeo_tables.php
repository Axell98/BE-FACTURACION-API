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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->string('id', 2)->primary();
            $table->string('nombre');
            $table->engine('InnoDB');
        });

        Schema::create('provincias', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('nombre');
            $table->string('departamento_id', 2);
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
        });

        Schema::create('distritos', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('nombre');
            $table->string('provincia_id', 4);
            $table->string('departamento_id', 2);
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('distritos');
    }
};

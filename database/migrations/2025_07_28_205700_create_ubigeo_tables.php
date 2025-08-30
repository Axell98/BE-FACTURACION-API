<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine('InnoDB');
        });

        Schema::create('distritos', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('nombre');
            $table->string('provincia_id', 4);
            $table->string('departamento_id', 2);
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->engine('InnoDB');
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

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
        Schema::create('datos_cab', function (Blueprint $table) {
            $table->string('id', '3')->primary();
            $table->string('descripcion', 250)->nullable();
        });

        Schema::create('datos_det', function (Blueprint $table) {
            $table->string('id_cab', '3');
            $table->string('id_det', '5');
            $table->string('descripcion', 250)->nullable(false);
            $table->integer('orden')->nullable();
            $table->boolean('activo')->default(true);
            $table->primary(['id_cab', 'id_det']);
            $table->foreign('id_cab')->references('id')->on('datos_cab')->onUpdate('cascade')->onDelete('cascade');
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

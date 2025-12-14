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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pad')
                ->nullable()
                ->constrained('menus')
                ->onDelete('cascade');
            $table->string('nombre', 150);
            $table->string('url', 150)->nullable();
            $table->string('icono', 100)->nullable();
            $table->boolean('activo')->default(true)->nullable();
            $table->integer('orden')->nullable();
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};

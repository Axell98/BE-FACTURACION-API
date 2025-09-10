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
        Schema::create('unidades', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('nombre', 150);
            $table->boolean('activo')->default(true);
            $table->string('created_by', 15)->nullable();
            $table->timestamp('created_at', 0);
            $table->string('updated_by', 15)->nullable();
            $table->timestamp('updated_at', 0);
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};

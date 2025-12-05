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
        Schema::create('marca', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('descripcion', 250)->nullable();
            $table->boolean('activo')->default(true);
            $table->string('created_by', 15)->nullable();
            $table->timestamp('created_at', 0);
            $table->string('updated_by', 15)->nullable();
            $table->timestamp('updated_at', 0);
            $table->string('deleted_by', 15)->nullable();
            $table->softDeletes();
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_marca');
    }
};

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
        Schema::create('menus_role', function (Blueprint $table) {
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_role');
            $table->primary(['id_menu', 'id_role']);
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_role');
    }
};

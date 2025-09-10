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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 25)->nullable();
            $table->string('razon_social', 250);
            $table->string('nombre_comercial', 250)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('direccion', 250)->nullable();
            $table->string('ubigeo', 6)->nullable();
            $table->string('pais', 5)->default('PE');
            $table->boolean('selva_bienes')->nullable();
            $table->boolean('selva_servicios')->nullable();
            $table->boolean('afecto_igv')->default(true);
            $table->decimal('igv', 7, 2)->default(18.00);
            $table->decimal('icbper', 7, 2)->default(0.50);
            $table->string('logo_url', 255)->nullable();
            $table->string('usuario_sol', 255)->nullable();
            $table->string('password_sol', 255)->nullable();
            $table->string('sunat_client_id', 255)->nullable();
            $table->string('sunat_secret_id', 255)->nullable();
            $table->string('key_publica', 255)->nullable();
            $table->string('key_privada', 255)->nullable();
            $table->string('cert_test_url', 255)->nullable();
            $table->string('cert_prod_url', 255)->nullable();
            $table->boolean('modo_prueba')->default(false)->nullable();
            $table->string('created_by', 15)->nullable();
            $table->timestamp('created_at', 0);
            $table->string('updated_by', 15)->nullable();
            $table->timestamp('updated_at', 0);
            $table->engine('InnoDB');
        });

        Schema::create('empresas_usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id_empresa')->nullable(false);
            $table->unsignedBigInteger('id_usuario')->nullable(false);
            $table->boolean('default')->nullable();
            $table->primary(['id_empresa', 'id_usuario']);
            $table->foreign('id_empresa')
                ->references('id')
                ->on('empresas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->engine('InnoDB');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas_usuario');
        Schema::dropIfExists('empresas');
    }
};

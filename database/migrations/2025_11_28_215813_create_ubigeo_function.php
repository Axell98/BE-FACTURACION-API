<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = "
            drop function if exists fun_get_ubigeo_descripcion;

            create function fun_get_ubigeo_descripcion(ubigeo_cod varchar(255))
            returns varchar(255)
            reads sql data
            begin
                declare ubigeo_desc varchar(255);
                select concat(e.nombre, ' - ', trim(p.nombre), ' - ', trim(d.nombre)) into ubigeo_desc
                from distritos as d
                left join provincias as p on p.id = d.provincia_id
                left join departamentos as e on e.id = d.departamento_id
                where d.id = ubigeo_cod;
                if ubigeo_desc is null then
                    return null;
                end if;
                return ubigeo_desc;
            end;
        ";
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('drop function if exists fun_get_ubigeo_descripcion;');
    }
};

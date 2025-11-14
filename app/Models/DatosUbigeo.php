<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DatosUbigeo extends Model
{
    public static function getUbigeo(array $params)
    {
        $query = DB::table('distritos as d')
            ->select([
                'd.id as dist_id',
                DB::raw("TRIM(d.nombre) as dist_nombre"),
                'p.id as prov_id',
                DB::raw("TRIM(p.nombre) as prov_nombre"),
                'e.id as dept_id',
                DB::raw("TRIM(e.nombre) as dept_nombre"),
            ])
            ->join('provincias as p', 'p.id', '=', 'd.provincia_id')
            ->join('departamentos as e', 'e.id', '=', 'd.departamento_id')
            ->orderBy('e.nombre')
            ->orderBy('p.nombre')
            ->orderBy('d.nombre');

        if (isset($params['departamento'])) {
            $query->where('e.id', $params['departamento']);
        }
        if (isset($params['provincia'])) {
            $query->where('p.id', $params['provincia']);
        }
        $dataSet = $query->get();
        $result = [];
        if ($params['agrupar']) {
            $result = self::agruparUbigeo($dataSet);
        } else {
            foreach ($dataSet->toArray() as $value) {
                $result[] = [
                    'id' => $value->dist_id,
                    'nombre' => "$value->dept_nombre - $value->prov_nombre - $value->dist_nombre",
                ];
            }
        }
        return $result;
    }

    public static function getPaises()
    {
        $query = DB::table('paises')->orderBy('nombre');
        $result = $query->get();
        return $result;
    }

    private static function agruparUbigeo($dataSet)
    {
        $result = $dataSet->reduce(function ($departamentos, $item) {
            if (!isset($departamentos[$item->dept_id])) {
                $departamentos[$item->dept_id] = [
                    'departamento_id' => $item->dept_id,
                    'departamento_nombre' => $item->dept_nombre,
                    'provincias' => []
                ];
            }
            if (!isset($departamentos[$item->dept_id]['provincias'][$item->prov_id])) {
                $departamentos[$item->dept_id]['provincias'][$item->prov_id] = [
                    'provincia_id' => $item->prov_id,
                    'provincia_nombre' => $item->prov_nombre,
                    'distritos' => []
                ];
            }
            $departamentos[$item->dept_id]['provincias'][$item->prov_id]['distritos'][] = [
                'distrito_id' => $item->dist_id,
                'distrito_nombre' => $item->dist_nombre
            ];
            return $departamentos;
        }, []);

        $result = array_map(function ($departamento) {
            $departamento['provincias'] = array_values($departamento['provincias']);
            foreach ($departamento['provincias'] as &$provincia) {
                $provincia['distritos'] = array_values($provincia['distritos']);
            }
            return $departamento;
        }, array_values($result));

        $result = array_values($result);
        return $result;
    }
}

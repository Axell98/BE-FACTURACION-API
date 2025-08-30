<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function getClientes(array $params = [])
    {
        $query = self::select();
        $result = $query->get();
        return $result->toArray();
    }
}

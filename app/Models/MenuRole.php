<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table = 'menus_role';
    protected $primaryKey = 'id_menu';
    public $incrementing = false;
    public $timestamps = false;
}

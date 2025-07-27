<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles, SoftDeletes;

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $guard_name = 'api';

    protected $fillable = [
        'usuario',
        'password',
        'nombre',
        'tipo_doc',
        'nume_doc',
        'celular',
        'direccion',
        'foto_url',
        'empresa_acceso',
        'empresa_actual',
        'activo',
    ];

    protected $hidden = [
        'password',
        'deleted_at'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getUser($id) {}

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, "role");
    }
}

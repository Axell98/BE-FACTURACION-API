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

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $guard_name = 'api';

    protected $fillable = [
        'usuario',
        'password',
        'nombres',
        'apellidos',
        'tipo_doc',
        'nume_doc',
        'fecha_nac',
        'celular',
        'direccion',
        'foto_url',
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
            'activo' => 'boolean'
        ];
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function listUsers(array $params)
    {
        $query = self::with('roles:id,name,display_name');
        if (isset($params['estado'])) {
            $query->where('activo', filter_var($params['estado'], FILTER_VALIDATE_BOOLEAN));
        }
        if (isset($params['rol'])) {
            $query->whereHas('roles', function ($query) use ($params) {
                $query->where('name', $params['rol']);
            });
        }
        $result = $query->get()->map(function ($user) {
            $data = $user->toArray();
            $data['roles'] = $user->roles->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'display_name' => $role->display_name,
                ];
            })->first();
            return $data;
        });
        return $result;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'estado' => $this->activo,
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, "role");
    }
}

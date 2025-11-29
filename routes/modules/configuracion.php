<?php

use App\Http\Controllers\Configuracion;
use Illuminate\Support\Facades\Route;

// middleware('permission:sucursal.view')

Route::prefix('roles')->group(function () {
    Route::get('', [Configuracion\RoleController::class, 'index']);
    Route::get('{id}', [Configuracion\RoleController::class, 'search'])->whereNumber('id');
    Route::post('', [Configuracion\RoleController::class, 'store']);
    Route::put('{id}', [Configuracion\RoleController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Configuracion\RoleController::class, 'remove'])->whereNumber('id');
});

Route::prefix('empresa')->group(function () {
    Route::get('', [Configuracion\EmpresaController::class, 'index']);
    Route::post('', [Configuracion\EmpresaController::class, 'store']);
});

Route::prefix('sucursales')->group(function () {
    Route::get('', [Configuracion\SucursalController::class, 'index']);
});

Route::prefix('usuarios')->group(function () {
    Route::get('', [Configuracion\UsuarioController::class, 'index']);
    Route::post('', [Configuracion\UsuarioController::class, 'store']);
    Route::post('upload-foto', [Configuracion\UsuarioController::class, 'photoUpload']);
    Route::put('update-password/{id}', [Configuracion\UsuarioController::class, 'updatePassword'])->whereNumber('id');
    Route::put('{id}', [Configuracion\UsuarioController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Configuracion\UsuarioController::class, 'remove'])->whereNumber('id');
});

Route::prefix('sistema')->group(function () {
    Route::prefix('datos')->group(function () {
        Route::get('', [Configuracion\DatosSistemaController::class, 'index']);
        Route::get('ubigeo', [Configuracion\DatosSistemaController::class, 'ubigeo']);
        Route::get('paises', [Configuracion\DatosSistemaController::class, 'paises']);
    });
    Route::prefix('menu')->group(function () {
        Route::get('', [Configuracion\MenuController::class, 'index']);
        Route::get('user', [Configuracion\MenuController::class, 'user']);
    });
    Route::get('permisos', [Configuracion\DatosSistemaController::class, 'permisos']);
});

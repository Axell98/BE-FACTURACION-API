<?php

use App\Http\Controllers\Configuracion;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('', [Configuracion\RoleController::class, 'index'])->middleware('permission:role.view');
    Route::get('{id}', [Configuracion\RoleController::class, 'search'])->whereNumber('id')->middleware('permission:role.view');
    Route::post('', [Configuracion\RoleController::class, 'store'])->middleware('permission:role.create');
    Route::put('{id}', [Configuracion\RoleController::class, 'update'])->whereNumber('id')->middleware('permission:role.edit');
    Route::delete('{id}', [Configuracion\RoleController::class, 'remove'])->whereNumber('id')->middleware('permission:role.delete');
});

Route::prefix('empresa')->group(function () {
    Route::get('', [Configuracion\EmpresaController::class, 'index'])->middleware('permission:empresa.view');
    Route::post('', [Configuracion\EmpresaController::class, 'store'])->middleware('permission:empresa.create');
});

Route::prefix('sucursales')->group(function () {
    Route::get('', [Configuracion\SucursalController::class, 'index'])->middleware('permission:sucursal.view');
});

Route::prefix('usuarios')->group(function () {
    Route::get('', [Configuracion\UsuarioController::class, 'index'])->middleware('permission:usuario.view');
    Route::post('', [Configuracion\UsuarioController::class, 'store'])->middleware('permission:usuario.create');
    Route::post('upload-foto', [Configuracion\UsuarioController::class, 'photoUpload'])->middleware('permission:usuario.create');
    Route::put('update-password/{id}', [Configuracion\UsuarioController::class, 'updatePassword'])->whereNumber('id')->middleware('permission:usuario.create');
    Route::put('{id}', [Configuracion\UsuarioController::class, 'update'])->whereNumber('id')->middleware('permission:usuario.edit');
    Route::delete('{id}', [Configuracion\UsuarioController::class, 'remove'])->whereNumber('id')->middleware('permission:usuario.delete');
});

Route::prefix('sistema')->group(function () {
    Route::prefix('datos')->group(function () {
        Route::get('ubigeo', [Configuracion\DatosSistemaController::class, 'ubigeo']);
        Route::get('paises', [Configuracion\DatosSistemaController::class, 'paises']);
        Route::get('tipos-documentos', [Configuracion\DatosSistemaController::class, 'documentos']);
        Route::get('tipos-comprobantes', [Configuracion\DatosSistemaController::class, 'comprobantes']);
    });
    Route::prefix('menu')->group(function () {
        Route::get('', [Configuracion\MenuController::class, 'index']);
        Route::get('user', [Configuracion\MenuController::class, 'user']);
    });
    Route::get('permisos', [Configuracion\DatosSistemaController::class, 'permisos']);
});

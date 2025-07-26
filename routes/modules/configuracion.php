<?php

use App\Http\Controllers\Configuracion;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('', [Configuracion\RoleController::class, 'index'])->middleware('permission:role.view');
    Route::post('', [Configuracion\RoleController::class, 'store'])->middleware('permission:role.create');
    Route::put('{id}', [Configuracion\RoleController::class, 'update'])->whereNumber('id')->middleware('permission:role.edit');
    Route::delete('{id}', [Configuracion\RoleController::class, 'remove'])->whereNumber('id')->middleware('permission:role.delete');
});

Route::prefix('usuarios')->group(function () {
    Route::get('', [Configuracion\UsuarioController::class, 'index'])->middleware('permission:user.view');
    Route::post('', [Configuracion\UsuarioController::class, 'store'])->middleware('permission:user.create');
    Route::put('{id}', [Configuracion\UsuarioController::class, 'update'])->whereNumber('id')->middleware('permission:user.edit');
    Route::delete('{id}', [Configuracion\UsuarioController::class, 'remove'])->whereNumber('id')->middleware('permission:user.delete');
});

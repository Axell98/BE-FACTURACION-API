<?php

use App\Http\Controllers\Configuracion;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('', [Configuracion\RoleController::class, 'index']);
    Route::post('', [Configuracion\RoleController::class, 'store']);
    Route::put('{id}', [Configuracion\RoleController::class, 'update'])->whereNumber('id');
    Route::delete('', [Configuracion\RoleController::class, 'remove']);
});

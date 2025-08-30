<?php

use App\Http\Controllers\Registros;
use Illuminate\Support\Facades\Route;

Route::prefix('clientes')->group(function () {
    Route::get('', [Registros\ClientesController::class, 'index'])->middleware('permission:clientes.view');
    Route::post('', [Registros\ClientesController::class, 'store'])->middleware('permission:clientes.create');
    Route::delete('{id}', [Registros\ClientesController::class, 'remove'])->middleware('permission:clientes.delete')->whereNumber('id');
});

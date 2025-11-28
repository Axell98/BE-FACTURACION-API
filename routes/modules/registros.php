<?php

use App\Http\Controllers\Registros;
use Illuminate\Support\Facades\Route;

Route::prefix('clientes')->group(function () {
    Route::get('', [Registros\ClientesController::class, 'index'])->middleware('permission:clientes.view');
    Route::post('', [Registros\ClientesController::class, 'store'])->middleware('permission:clientes.create');
    Route::put('{id}', [Registros\ClientesController::class, 'update'])->middleware('permission:clientes.edit')->whereNumber('id');
    Route::delete('{id}', [Registros\ClientesController::class, 'remove'])->middleware('permission:clientes.delete')->whereNumber('id');
});

Route::prefix('proveedores')->group(function () {
    Route::get('', [Registros\ProveedoresController::class, 'index'])->middleware('permission:clientes.view');
    Route::post('', [Registros\ProveedoresController::class, 'store'])->middleware('permission:clientes.create');
    Route::post('importar', [Registros\ProveedoresController::class, 'importData']);
    Route::get('exportar', [Registros\ProveedoresController::class, 'exportData']);
    Route::put('{id}', [Registros\ProveedoresController::class, 'update'])->middleware('permission:clientes.edit')->whereNumber('id');
    Route::delete('{id}', [Registros\ProveedoresController::class, 'remove'])->middleware('permission:clientes.delete')->whereNumber('id');
});

Route::prefix('categorias')->group(function () {
    Route::get('', [Registros\CategoriasController::class, 'index'])->middleware('permission:categorias.view');
    Route::post('', [Registros\CategoriasController::class, 'store'])->middleware('permission:categorias.create');
    Route::put('{id}', [Registros\CategoriasController::class, 'update'])->middleware('permission:categorias.edit')->whereNumber('id');
    Route::delete('{id}', [Registros\CategoriasController::class, 'remove'])->middleware('permission:categorias.delete')->whereNumber('id');
});

Route::prefix('unidades')->group(function () {
    Route::get('', [Registros\UnidadesController::class, 'index'])->middleware('permission:unidades.view');
    Route::post('', [Registros\UnidadesController::class, 'store']);
    Route::put('{id}', [Registros\UnidadesController::class, 'update'])->whereNumber('id');
});

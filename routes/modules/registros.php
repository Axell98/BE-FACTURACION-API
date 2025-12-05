<?php

use App\Http\Controllers\Registros;
use Illuminate\Support\Facades\Route;

Route::prefix('clientes')->group(function () {
    Route::get('', [Registros\ClientesController::class, 'index']);
    Route::post('', [Registros\ClientesController::class, 'store']);
    Route::post('importar', [Registros\ClientesController::class, 'importData']);
    Route::get('exportar', [Registros\ClientesController::class, 'exportData']);
    Route::put('{id}', [Registros\ClientesController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Registros\ClientesController::class, 'remove'])->whereNumber('id');
});

Route::prefix('proveedores')->group(function () {
    Route::get('', [Registros\ProveedoresController::class, 'index']);
    Route::post('', [Registros\ProveedoresController::class, 'store']);
    Route::post('importar', [Registros\ProveedoresController::class, 'importData']);
    Route::get('exportar', [Registros\ProveedoresController::class, 'exportData']);
    Route::put('{id}', [Registros\ProveedoresController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Registros\ProveedoresController::class, 'remove'])->whereNumber('id');
});

Route::prefix('categorias')->group(function () {
    Route::get('', [Registros\CategoriasController::class, 'index']);
    Route::post('', [Registros\CategoriasController::class, 'store']);
    Route::put('{id}', [Registros\CategoriasController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Registros\CategoriasController::class, 'remove'])->whereNumber('id');
});

Route::prefix('marcas')->group(function () {
    Route::get('', [Registros\MarcasController::class, 'index']);
    Route::post('', [Registros\MarcasController::class, 'store']);
    Route::put('{id}', [Registros\MarcasController::class, 'update'])->whereNumber('id');
    Route::delete('{id}', [Registros\MarcasController::class, 'remove'])->whereNumber('id');
});

Route::prefix('unidades')->group(function () {
    Route::get('', [Registros\UnidadesController::class, 'index']);
    Route::post('', [Registros\UnidadesController::class, 'store']);
    Route::put('{id}', [Registros\UnidadesController::class, 'update'])->whereNumber('id');
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        require_once base_path('routes/modules/auth.php');
    });
    Route::prefix('registro')->middleware('jwt.auth')->group(function () {
        require_once base_path('routes/modules/registros.php');
    });
    Route::prefix('configuracion')->middleware('jwt.auth')->group(function () {
        require_once base_path('routes/modules/configuracion.php');
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// ->middleware('jwt.auth')
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        require_once base_path('routes/modules/auth.php');
    });
    Route::prefix('configuracion')->group(function () {
        require_once base_path('routes/modules/configuracion.php');
    });
});

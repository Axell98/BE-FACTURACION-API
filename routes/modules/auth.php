<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
Route::get('refresh-token', [AuthController::class, 'refresh']);
Route::post('logout', [AuthController::class, 'logout']);

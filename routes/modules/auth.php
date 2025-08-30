<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->middleware('jwt.auth');
Route::get('profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
Route::get('refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

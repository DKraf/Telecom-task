<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

//Роуты авторизации
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Ресурс Новостей, требует авторизации
Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('/news', NewsController::class);
});

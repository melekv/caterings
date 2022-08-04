<?php

use App\Http\Controllers\Web\InputController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/save', [InputController::class, 'store']);

Route::get('/admin/{time_span}', [AdminController::class, 'show'])->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

Route::get('/', function () {
    return view('main');
});

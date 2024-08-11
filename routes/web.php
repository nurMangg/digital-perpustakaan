<?php

use Illuminate\Support\Facades\Route;

Route::get('/buku/export-excel', [App\Http\Controllers\BukuController::class, 'exportExcel'])->name('buku.exportExcel');
Route::get('/buku/export-pdf', [App\Http\Controllers\BukuController::class, 'exportPdf'])->name('buku.exportpdf');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::POST('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('/', App\Http\Controllers\DashboardController::class);
    Route::resource('buku', App\Http\Controllers\BukuController::class);
    Route::resource('kategori-buku', App\Http\Controllers\KategoriBukuController::class);

});




<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RumahSakitController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/rumah-sakit', function () {
        return view('rumahSakit.data');
    })->name('rumahSakit.data');

    Route::get('/rumah-sakit', [RumahSakitController::class, 'index'])->name('rumahsakit.index');
    Route::get('/rumah-sakit/data', [RumahSakitController::class, 'getData'])->name('rumahsakit.data');
    Route::get('/rumah-sakit/form', [RumahSakitController::class, 'form'])->name('rumahsakit.form');
    Route::post('/rumah-sakit/store', [RumahSakitController::class, 'store'])->name('rumahsakit.store');
    Route::get('/rumah-sakit/{id}/edit', [RumahSakitController::class, 'edit'])->name('rumahsakit.edit');
    Route::put('/rumah-sakit/update/{id}', [RumahSakitController::class, 'update'])->name('rumahsakit.update');
    Route::delete('/rumah-sakit/{id}', [RumahSakitController::class, 'destroy'])->name('rumahsakit.destroy');
});

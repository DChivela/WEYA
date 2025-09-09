<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PacoteTuristicoController;
use App\Http\Controllers\PromocaoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/corridas', CorridaController::class);
    Route::resource('/motoristas', MotoristaController::class);
    Route::resource('/pacotes', PacoteTuristicoController::class);
    Route::resource('/promocoes', PromocaoController::class);
});

require __DIR__ . '/auth.php';

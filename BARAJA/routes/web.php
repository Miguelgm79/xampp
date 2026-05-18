<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;

Route::get('/juego', [JuegoController::class, 'index'])->name('juego.index');
Route::post('/juego/adivinar', [JuegoController::class, 'adivinar'])->name('juego.adivinar');



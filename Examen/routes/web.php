<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;

Route::get('/mayor', [JuegoController::class, 'inicializacion'])->name('mayor.inicializacion');
Route::post('/mayor/jugar', [JuegoController::class, 'jugar'])->name('mayor.jugar');
Route::post('/mayor/reiniciar', [JuegoController::class, 'reiniciar'])->name('mayor.reiniciar');

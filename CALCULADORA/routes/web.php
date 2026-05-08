<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/', [CalculadoraController::class, 'index'])->name('calculadora');
Route::post('/calculadora/calcular', [CalculadoraController::class, 'calcular'])->name('calculadora.calcular');
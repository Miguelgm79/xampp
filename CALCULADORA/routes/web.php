<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora.index');

Route::post('/calculadora', [CalculadoraController::class, 'calcular'])->name('calculadora.calcular');

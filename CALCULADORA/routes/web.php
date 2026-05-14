<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\AhorcadoController;
use App\Http\Controllers\GameController;


//Calculadora
Route::get('/',           [CalculadoraController::class, 'index'])->name('calculadora');
Route::post('/digito',    [CalculadoraController::class, 'digito'])->name('digito');
Route::post('/operacion', [CalculadoraController::class, 'operacion'])->name('operacion');
Route::post('/calcular',  [CalculadoraController::class, 'calcular'])->name('calcular');
Route::post('/unaria',    [CalculadoraController::class, 'unaria'])->name('unaria');
Route::post('/activar',   [CalculadoraController::class, 'activar'])->name('activar');
Route::post('/borrar',    [CalculadoraController::class, 'borrar'])->name('borrar');
Route::post('/limpiar',   [CalculadoraController::class, 'limpiar'])->name('limpiar');

//Session
    Route::get('/sesion', [SesionController::class, 'index']);

    Route::post('/sesion/incrementar', [SesionController::class, 'incrementar']);
    Route::post('/sesion/decrementar', [SesionController::class, 'decrementar']);
    Route::post('/sesion/reset', [SesionController::class, 'reset']);

//Ahorcado
Route::get('/ahorcado', [AhorcadoController::class, 'index'])->name('ahorcado.index');
Route::post('/ahorcado/letra', [AhorcadoController::class, 'probarLetra'])->name('ahorcado.letra');
Route::post('/ahorcado/reiniciar', [AhorcadoController::class, 'reiniciar'])->name('ahorcado.reiniciar');

//Consejos
Route::post('/juego', [GameController::class, 'setup']);
Route::get('/juego', function () {
    return view('juego'); 
});
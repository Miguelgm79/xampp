<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SesionController;

Route::get('/', [HomeController::class, 'index']);

// Route::get('catalog', [CatalogController::class, 'getIndex']);

Route::get('catalog/show/{id}', [CatalogController::class, 'getShow']);

Route::get('catalog/create', [CatalogController::class, 'getCreate']);
/**
 * Solo responde a peticiones POST
 * CatalogController::class, 'postCreate' --> Cuando alguien haga POST a esa URL 'postCreate'
 */
Route::post('catalog/create', [CatalogController::class, 'postCreate']);

Route::get('catalog/edit/{id}', [CatalogController::class, 'getEdit']);
Route::put('catalog/edit/{id}', [CatalogController::class, 'putEdit']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', [LoginController::class, 'logout']);

Route::get('catalog', [CatalogController::class, 'getIndex'])->middleware('auth');

Route::middleware(['auth'])->group(function () {

    Route::get('/sesion', [SesionController::class, 'index']);

    Route::post('/sesion/incrementar', [SesionController::class, 'incrementar']);
    Route::post('/sesion/decrementar', [SesionController::class, 'decrementar']);
    Route::post('/sesion/reset', [SesionController::class, 'reset']);

});
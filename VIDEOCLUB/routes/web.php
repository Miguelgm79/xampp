<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;

Route::get('/', [CatalogController::class, 'getHome']);


Route::get('login', function () {
    return view('auth.login');
});

Route::get('logout', function () {
    return 'Logout usuario';
});

Route::get('catalog', [CatalogController::class, 'getIndex']);

Route::get('catalog/show/{id}', [CatalogController::class, 'getShow']) ->where('id', '[0-9]+');

Route::get('catalog/create', [CatalogController::class, 'getCreate']);

Route::get('catalog/edit/{id?}', [CatalogController::class, 'getEdit']);

?>


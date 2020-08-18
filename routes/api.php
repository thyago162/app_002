<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Portal')->group(function () {

    Route::get('loja/produtos/{id}', 'LojaController@produtos')->name('produtos_loja');

    Route::resource('lojas', 'LojaController', ['except' => 'edit', 'create']);
    Route::resource('produtos', 'ProdutoController', ['except' => 'edit', 'create']);
});

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

Route::get('teste', function () {
    return response()->json('teste', 200);
});

Route::get('inicializacao','ClimaController@inicializacao');
Route::post('obter-cidades','ClimaController@obterCidades');
Route::get('obter-previsao/{cidade}','ClimaController@obterPrevisao');

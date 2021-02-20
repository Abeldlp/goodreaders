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
Route::prefix('/books')->group(function(){
    Route::get('/', 'BookController@index');
    Route::post('/save', 'BookController@store');
    Route::put('/{id}', 'BookController@update');
    Route::get('/{id}', 'BookController@show');
    Route::delete('/{id}', 'BookController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

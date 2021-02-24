<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::prefix('/api')->group(function () {
    Route::prefix('/books')->group(function(){
        Route::get('/', 'BookController@index');
        Route::post('/save', 'BookController@store')->middleware('auth');
        Route::put('/{book}', 'BookController@update')->middleware('auth');
        Route::get('/{book}', 'BookController@show');
        Route::delete('/{book}', 'BookController@destroy')->middleware('auth');
    });

    Route::prefix('/rating')->middleware('auth')->group(function(){
        Route::post('/', 'RatingController@store');
        Route::put('/{id}', 'RatingController@update');
        Route::delete('/{id}', 'RatingController@destroy');
    });

    Route::prefix('/reply')->middleware('auth')->group(function(){
        Route::post('/', 'RatingController@store');
        Route::put('/{id}', 'RatingController@update');
        Route::delete('/{id}', 'RatingController@destroy');
    });
});

Route::get('/{any}', 'SpaController@index')->where('any', '.*');





<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/books')->group(function(){
    Route::get('/', 'BookController@index');
    Route::post('/save', 'BookController@store')->middleware('auth');
    Route::put('/{id}', 'BookController@update')->middleware('auth');//->middleware('can:update,App\Book');
    Route::get('/{id}', 'BookController@show');
    Route::delete('/{id}', 'BookController@destroy');
});

Route::prefix('/rating')->group(function(){
    Route::post('/', 'RatingController@store');
    Route::put('/{id}', 'RatingController@update');
    Route::delete('/{id}', 'RatingController@destroy');
});

Route::prefix('/reply')->group(function(){
    Route::post('/', 'RatingController@store');
    Route::put('/{id}', 'RatingController@update');
    Route::delete('/{id}', 'RatingController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

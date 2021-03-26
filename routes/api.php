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
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [\App\Http\Controllers\Auth\ApiAuthController::class, 'login']);
    Route::post('/register',[\App\Http\Controllers\Auth\ApiAuthController::class, 'register']);
});
Route::middleware('auth:api')->group(function () {
    //return $request->user();
    Route::post('/logout', 'Auth\ApiAuthController@logout');

    Route::group(['prefix' => 'users'], function() {
        Route::patch('/update', [\App\Http\Controllers\UserController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\UserController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\UserController::class, 'show']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'movies',
    ], function() {
        Route::post('/create', [ \App\Http\Controllers\MoviesController::class,'store']);
        Route::get('/all',  [\App\Http\Controllers\MoviesController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\MoviesController::class, 'show']);
        Route::patch('/update', [\App\Http\Controllers\MoviesController::class, 'update']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\MoviesController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'cinemas',
    ], function() {
        Route::post('/create', [\App\Http\Controllers\CinemaController::class, 'store']);
        Route::patch('/update', [\App\Http\Controllers\CinemaController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\CinemaController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\CinemaController::class, 'show']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\CinemaController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'show-time',
    ], function() {
        Route::post('/create', [\App\Http\Controllers\ShowTimeController::class, 'store']);
        Route::patch('/update', [\App\Http\Controllers\ShowTimeController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\ShowTimeController::class, 'index']);
        Route::get('/show/{id}', [\App\Http\Controllers\ShowTimeController::class, 'show']);
        Route::delete('/delete/{id}', [\App\Http\Controllers\ShowTimeController::class, 'destroy']);
    });
});

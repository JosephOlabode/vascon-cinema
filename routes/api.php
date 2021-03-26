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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
    Route::post('/logout', 'Auth\ApiAuthController@logout');

    Route::group(['prefix' => 'app/users'], function() {
        Route::patch('/update', [\App\Http\Controllers\UserController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\UserController::class, 'index']);
        Route::get('/user/{id}', [\App\Http\Controllers\UserController::class, 'show']);
        Route::delete('/user/{id}', [\App\Http\Controllers\UserController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'app/movies',
    ], function() {
        Route::post('/create', 'MoviesController@store');
        Route::get('/all', 'MoviesController@index');
        Route::get('/movie/{id}', 'MoviesController@show');
        Route::patch('/update', 'MoviesController@update');
        Route::delete('/movie/{id}', 'MoviesController@destroy');
    });

    Route::group([
        'prefix' => 'app/cinema',
    ], function() {
        Route::post('/create', [\App\Http\Controllers\CinemaController::class, 'store']);
        Route::patch('/update', [\App\Http\Controllers\CinemaController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\CinemaController::class, 'index']);
        Route::get('/cinema/{id}', [\App\Http\Controllers\CinemaController::class, 'show']);
        Route::delete('/cinema/{id}', [\App\Http\Controllers\CinemaController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'app/show-time',
    ], function() {
        Route::post('/create', [\App\Http\Controllers\ShowTimeController::class, 'store']);
        Route::patch('/update', [\App\Http\Controllers\ShowTimeController::class, 'update']);
        Route::get('/all', [\App\Http\Controllers\ShowTimeController::class, 'index']);
        Route::get('/show-time/{id}', [\App\Http\Controllers\ShowTimeController::class, 'show']);
        Route::delete('/show-time/{id}', [\App\Http\Controllers\ShowTimeController::class, 'destroy']);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JwtAuthController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [JwtAuthController::class, 'register']);
    Route::post('/login', [JwtAuthController::class, 'login']);
    Route::middleware(["auth.jwt"])->group(function () {
        Route::post('/token/refresh', [JwtAuthController::class, 'token.refresh']);
        Route::post('/logout', [JwtAuthController::class, 'logout']);
    });
});

Route::middleware(["auth.jwt"])->group(function () {
    Route::get('/user', [JwtAuthController::class, 'user']);
    Route::get('/hello', function () {
        return "world";
    });
});
Route::get('/test', function () {
    return ":)";
});

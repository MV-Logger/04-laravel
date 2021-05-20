<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\JwtAuthController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [JwtAuthController::class, 'register']);
    Route::post('/login', [JwtAuthController::class, 'login']);
    Route::middleware(["auth.jwt"])->group(function () {
        Route::get("/authenticad", function () {
            return response(null, 200);
        });
        Route::post('/token/refresh', [JwtAuthController::class, 'token.refresh']);
        Route::post('/logout', [JwtAuthController::class, 'logout']);
    });
});

//validation through implicit binding

Route::middleware(["auth.jwt"])->group(function () {
    Route::get('/user', [JwtAuthController::class, 'user']);
    Route::get("/books", [BookController::class, "getBooks"]);
    Route::post("/books", [BookController::class, "addBook"]);
    Route::get("books/{book}", [BookController::class, "getBook"]);
    Route::put("books/{book}", [BookController::class, "updateBook"]);
    Route::delete("books/{book}", [BookController::class, "deleteBook"]);
    Route::get("/books/{book}/entries", [EntryController::class, "getEntries"]);
    Route::post("/books/{book}/entries", [EntryController::class, "addEntry"]);
});


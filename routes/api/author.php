<?php

use App\Models\Author;
use App\Services\AuthService;

AuthService::routes(Author::AUTH_GUARD, true, true);

Route::middleware('auth:' . Author::AUTH_GUARD)->group(function () {

    Route::middleware('book.owner')->group(function () {
        Route::apiResource('books', 'BookController');
    });

});

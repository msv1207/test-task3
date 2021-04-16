<?php

use App\Models\Author;
use App\Services\AuthService;
use App\Services\AvatarService;

AuthService::routes(Author::AUTH_GUARD);

Route::middleware('auth:' . Author::AUTH_GUARD)->group(function () {

    AvatarService::routes();

    Route::middleware(['author.active', 'book.owner'])->group(function () {
        Route::apiResource('books', 'BookController');
        Route::post('books/{book:id}/image', 'BookController@updateImage');
    });

});

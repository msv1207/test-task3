<?php

use App\Models\Admin;
use App\Services\AuthService;

AuthService::routes(Admin::AUTH_GUARD, false);

Route::apiResource('authors', 'AuthorController')->only(['show', 'index']);
Route::put('authors/{author:id}/block', 'AuthorController@block');

Route::apiResource('books', 'BookController')->only(['show', 'index']);
Route::put('books/{book:id}/block', 'BookController@block');

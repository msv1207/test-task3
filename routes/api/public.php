<?php

Route::get('books', 'BookController@index');
Route::get('authors', 'AuthorController@index');

Route::post('email_confirm/{email_confirm:id}', 'EmailConfirmController');

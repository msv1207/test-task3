<?php

use App\Models\User;
use App\Services\AuthService;
use App\Services\AvatarService;

AuthService::routes(User::AUTH_GUARD);

Route::middleware('auth:' . User::AUTH_GUARD)->group(function () {

    AvatarService::routes();

});

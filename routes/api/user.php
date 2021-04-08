<?php

use App\Models\User;
use App\Services\AuthService;

AuthService::routes(User::AUTH_GUARD, true, true);

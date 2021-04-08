<?php

use App\Models\Admin;
use App\Services\AuthService;

AuthService::routes(Admin::AUTH_GUARD, false, true);

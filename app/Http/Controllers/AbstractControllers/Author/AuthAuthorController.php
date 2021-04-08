<?php

namespace App\Http\Controllers\AbstractControllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Closure;
use Illuminate\Http\Request;

abstract class AuthAuthorController extends Controller
{
    protected Author $authAuthor;

    public function __construct()
    {
        $this->middleware('auth:' . Author::AUTH_GUARD);
        $this->middleware(function (Request $request, Closure $next) {
            $this->authAuthor = auth(Author::AUTH_GUARD)->user();

            return $next($request);
        });
    }

    protected function getStorageBasePath(): string
    {
        return "authors/{$this->authAuthor->id}";
    }
}

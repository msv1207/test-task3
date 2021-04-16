<?php

namespace App\Http\Middleware\Author;

use App\Models\Author;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorActive
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var Author $authAuthor */
        $authAuthor = auth(Author::AUTH_GUARD)->user();

        if ($authAuthor && $authAuthor->status === Author::STATUS_ACTIVE) {
            abort(Response::HTTP_FORBIDDEN, 'account_blocked');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware\Author;

use App\Models\Author;
use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookOwner
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
        /** @var Book $book */
        $book = $request->book;

        /** @var Author $authAuthor */
        $authAuthor = auth(Author::AUTH_GUARD)->user();

        if ($book && $book->author_id !== $authAuthor->id) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}

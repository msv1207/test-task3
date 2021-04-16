<?php

namespace App\Http\Controllers\PublicControllers;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function index(): Response
    {
        $books = Book::query()
            ->active()
            ->with('author')
            ->whereHas('author', fn(Builder $query) => $query->active())
            ->latest()
            ->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }
}

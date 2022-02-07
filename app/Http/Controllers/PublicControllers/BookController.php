<?php

namespace App\Http\Controllers\PublicControllers;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
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

    public function filter(Request $request)
    {
        $filter=$request->validate([
            'filter'  => 'required|string|max:255'
        ])['filter'];
        $books = Book::query()
            ->where('ganre', '=', "$filter")
            ->with('author')
            ->whereHas('author', fn(Builder $query) => $query->active())
            ->latest()
            ->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }
    public function sort(Request $request)
    {

        $sort_by=$request->validate([
            'sort_by'  => 'required|string|min:3|max:4'
        ])['sort_by'];
        $books = Book::query()
            ->with('author')
            ->whereHas('author', fn(Builder $query) => $query->active())
            ->latest()
            ->orderBy('ganre', "$sort_by")
            ->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }
}

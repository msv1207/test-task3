<?php

namespace App\Http\Controllers\PublicControllers;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function index(): Response
    {
        $books = Book::query()->with('author')->latest()->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }
}

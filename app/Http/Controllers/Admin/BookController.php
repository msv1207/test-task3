<?php

namespace App\Http\Controllers\Admin;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\AbstractControllers\Admin\AuthAdminController;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Response;

class BookController extends AuthAdminController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        parent::__construct();

        $this->bookService = $bookService;
    }

    public function show(Book $book): Response
    {
        return $this->successResponse(new BookResource($book));
    }

    public function index(): Response
    {
        $books = Book::query()
            ->with('author')
            ->latest()
            ->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }

    public function block(Book $book): Response
    {
        $blockedBook = $this->bookService->block($book);

        return $this->successResponse(new BookResource($blockedBook));
    }
}

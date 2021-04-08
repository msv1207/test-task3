<?php

namespace App\Http\Controllers\Author;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\AbstractControllers\Author\AuthAuthorController;
use App\Http\Requests\Author\StoreOrUpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Response;

class BookController extends AuthAuthorController
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
        $books = $this->authAuthor->books()->latest()->simplePaginate();

        return $this->successResponse(new BookCollection($books));
    }

    public function store(StoreOrUpdateBookRequest $request): Response
    {
        $newBook = $this->bookService->create($this->authAuthor, $request->validated());

        return $this->successCreatedResponse(new BookResource($newBook));
    }

    public function update(Book $book, StoreOrUpdateBookRequest $request): Response
    {
        $updatedBook = $this->bookService->update($book, $request->validated());

        return $this->successResponse(new BookResource($updatedBook));
    }

    public function destroy(Book $book): Response
    {
        $this->bookService->delete($book);

        return $this->successDeletedResponse();
    }
}

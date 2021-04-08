<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\AbstractControllers\Author\AuthAuthorController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends AuthAuthorController
{
    public function show(Book $book): Response
    {
        return $this->successResponse();
    }

    public function store(Request $request): Response
    {
        return response($request->all(), Response::HTTP_CREATED);
    }

    public function update(Book $book, Request $request): Response
    {
        return $this->successResponse($request->all());
    }

    public function delete(Book $book): Response
    {
        return $this->successDeletedResponse();
    }
}

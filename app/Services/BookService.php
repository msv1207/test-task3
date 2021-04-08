<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;

class BookService
{
    public function create(Author $author, array $data): Book
    {
        return $author->books()->create($data);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);

        return $book;
    }

    public function delete(Book $book): bool
    {
        return $book->delete();
    }
}

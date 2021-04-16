<?php

namespace App\Services;

use App\Models\Author;
use Hash;

class AuthorService
{
    public function create(array $data): Author
    {
        $data['password'] = Hash::make($data['password']);

        return Author::query()->create($data);
    }

    public function block(Author $author): Author
    {
        $author->update(['status' => Author::STATUS_BLOCKED]);

        return $author;
    }
}

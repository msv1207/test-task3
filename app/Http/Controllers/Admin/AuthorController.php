<?php

namespace App\Http\Controllers\Admin;

use App\Http\Collections\AuthorCollection;
use App\Http\Controllers\AbstractControllers\Admin\AuthAdminController;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Response;

class AuthorController extends AuthAdminController
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        parent::__construct();

        $this->authorService = $authorService;
    }

    public function show(Author $author): Response
    {
        return $this->successResponse(new AuthorResource($author));
    }

    public function index(): Response
    {
        $authors = Author::query()
            ->latest()
            ->simplePaginate();

        return $this->successResponse(new AuthorCollection($authors));
    }

    public function block(Author $author): Response
    {
        $blockedAuthor = $this->authorService->block($author);

        return $this->successResponse(new AuthorResource($blockedAuthor));
    }
}

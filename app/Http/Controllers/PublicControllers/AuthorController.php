<?php

namespace App\Http\Controllers\PublicControllers;

use App\Http\Collections\AuthorCollection;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index(): Response
    {
        $authors = Author::query()
            ->active()
            ->latest()
            ->simplePaginate();

        return $this->successResponse(new AuthorCollection($authors));
    }
}

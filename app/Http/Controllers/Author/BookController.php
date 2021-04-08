<?php

namespace App\Http\Controllers\Author;

use App\Http\Collections\BookCollection;
use App\Http\Controllers\AbstractControllers\Author\AuthAuthorController;
use App\Http\Requests\Author\StoreOrUpdateBookRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ImageResource;
use App\Models\Book;
use App\Services\BookService;
use App\Services\ImageService;
use Illuminate\Http\Response;

class BookController extends AuthAuthorController
{
    private BookService $bookService;
    private ImageService $imageService;

    public function __construct(BookService $bookService, ImageService $imageService)
    {
        parent::__construct();

        $this->bookService = $bookService;
        $this->imageService = $imageService;
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

    public function store(StoreOrUpdateBookRequest $request, ImageService $imageService): Response
    {
        $newBook = $this->bookService->create($this->authAuthor, $request->validated());
        if ($request->hasFile('image')) {
            $imageService->setStorage('public')
                ->setBasePath($this->getStorageBasePath())
                ->upload($newBook, $request->file('image'));
        }

        return $this->successCreatedResponse(new BookResource($newBook));
    }

    public function update(Book $book, StoreOrUpdateBookRequest $request): Response
    {
        $updatedBook = $this->bookService->update($book, $request->validated());

        return $this->successResponse(new BookResource($updatedBook));
    }

    public function updateImage(Book $book, UploadImageRequest $request, ImageService $imageService): Response
    {
        $updatedImage = $imageService->setStorage('public')
            ->setBasePath($this->getStorageBasePath())
            ->upload($book, $request->file('image'));

        return $this->successResponse(new ImageResource($updatedImage));
    }

    public function destroy(Book $book): Response
    {
        $this->bookService->delete($book);

        return $this->successDeletedResponse();
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Book
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if (!$this->resource) return [];

        $data = [
            'id'                => $this->id,
            'title'             => $this->title,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'created_at'        => $this->created_at,
            'author'            => new AuthorResource($this->author),
        ];

        if ($this->relationLoaded('author')) {
            $data['author'] = new AuthorResource($this->author);
        }

        return $data;
    }
}

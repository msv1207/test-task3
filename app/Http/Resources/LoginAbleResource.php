<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\Interfaces\LoginAbleInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int id
 * @property string email
 * @property ?string email_verified_at
 */
class LoginAbleResource extends JsonResource
{
    /**
     * @var LoginAbleInterface
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if (!$this->resource) return [];

        return [
            'id'                => $this->id,
            'guard'             => $this->resource->getAuthGuard(),
            'email'             => $this->email,
            'email_verified_at' => $this->email_verified_at,
        ];
    }
}

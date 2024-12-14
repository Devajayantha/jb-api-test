<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @see \App\Models\Post
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user_name' => $this->resource->user_name,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'created_at' => $this->resource->created_at,
        ];
    }
}

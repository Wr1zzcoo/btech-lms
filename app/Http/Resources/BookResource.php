<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'available_quantity' => $this->available_quantity,
            'is_available' => $this->is_available,

            'publisher' => $this->whenLoaded('publisher', PublisherResource::make($this->publisher)),

            'authors' => $this->whenLoaded('authors', AuthorResource::collection($this->authors)),

        ];
    }
}

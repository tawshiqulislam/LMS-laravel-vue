<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $rating = number_format((float) $this->rating, 1, '.', '');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'designation' => $this->designation,
            'description' => $this->description,
            'image' => $this->mediaPath,
            'is_active' => $this->is_active,
            'rating' => $rating,
            'created_at' => $this->created_at,
        ];
    }
}

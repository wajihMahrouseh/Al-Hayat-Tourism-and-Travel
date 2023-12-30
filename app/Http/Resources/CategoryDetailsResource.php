<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SitesListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailsResource extends JsonResource
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
            'image' => $this->getFirstMediaUrl('photos'),

            'sites' => $this->whenLoaded('sites', function () {
                return $this->sites ? SitesListResource::collection($this->sites) : null;
            }),
        ];
    }
}

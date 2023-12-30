<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;
use App\Http\Resources\JourneysListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,

            'images' => $this->whenLoaded('media', function () {
                return MediaResource::collection($this->media);
            }),

            'journeys' => $this->whenLoaded('journeys', function () {
                return $this->journeys ? JourneysListResource::collection($this->journeys) : null;
            }),
        ];
    }
}

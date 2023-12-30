<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JourneyDetailsResource extends JsonResource
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
            'startDate' => $this->start_date,
            'duration' => $this->duration,
            'price' => $this->price,
            'description' => $this->description,

            'rows' => $this->rows,
            'rightColumns' => $this->right_columns,
            'leftColumns' => $this->left_columns,
            'backColumns' => $this->back_columns,
        ];
    }
}

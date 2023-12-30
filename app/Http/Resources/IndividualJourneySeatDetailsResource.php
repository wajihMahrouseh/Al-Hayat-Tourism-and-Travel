<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndividualJourneySeatDetailsResource extends JsonResource
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
            'seat_number' => $this->seat_number,
            'name' => $this->first_name . ' ' . $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'fatherName' => $this->father_name,
            'motherName' => $this->mother_name,
            'placeAndDateBirth' => $this->place_and_birth_date,
            'nationalNumber' => $this->national_number,
            'frontId' => $this->media[0]->getUrl(),
            'backId' => $this->media[1]->getUrl(),
        ];
    }
}

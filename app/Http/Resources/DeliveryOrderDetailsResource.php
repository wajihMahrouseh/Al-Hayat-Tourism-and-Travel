<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryOrderDetailsResource extends JsonResource
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
            "id" => $this->id,
            "governorate" => $this->governorate,
            "region" => $this->region,
            "street" => $this->street,
            "buildingNumber" => $this->building_number,
            "details" => $this->details,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "status" => $this->status,
        ];
    }
}

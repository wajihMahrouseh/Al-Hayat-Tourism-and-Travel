<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryOrdersListResource extends JsonResource
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
            'startDate' => $this->reservationOrder->journey->start_date,
            'location' => $this->government . ' ' . $this->street,
            'passengers' => $this->reservationOrder->total_journey_seat_num,
        ];
    }
}

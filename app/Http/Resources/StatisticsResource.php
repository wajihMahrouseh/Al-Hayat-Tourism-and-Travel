<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
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
            'site' => $this->site->name,
            'tickets' => $this->individual_journey_seats_count,
            'totalPrice' => $this->price * $this->individual_journey_seats_count,
        ];
    }
}

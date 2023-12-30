<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CompanyJourneySeatListResource;

class ReservationOrderDetailsResource extends JsonResource
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

            'journey' => $this->when($this->relationLoaded('journey') && $this->journey->relationLoaded('site'), function () {
                return $this->journey->site->name;
            }),
            'passengers' => $this->total_journey_seat_num,
            'deliveryOrder' => $this->whenLoaded('deliveryOrder', function () {
                return !!$this->deliveryOrder;
            }),

            'deliveryOrderDetails' => $this->whenLoaded('deliveryOrder', function () {
                return !!$this->deliveryOrder;
            }),

            'status' => $this->status,

            'individualJourneySeats' => $this->whenLoaded('individualJourneySeats', function () {
                return IndividualJourneySeatListResource::collection($this->individualJourneySeats);
            }),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsDetailsResource extends JsonResource
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
            'whoUs' => $this->who_us,
            'phone' => $this->phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'address' => $this->address,
            'workTime' => $this->work_time,
        ];
    }
}

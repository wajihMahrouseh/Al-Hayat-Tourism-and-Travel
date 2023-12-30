<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'governorate' => ['required', 'string', 'min:3', 'max:50'],
            'region' => ['required', 'string', 'min:3', 'max:50'],
            'street' => ['required', 'string', 'min:3', 'max:50'],
            'buildingNumber' => ['required', 'string', 'min:3', 'max:50'],
            'details' => ['required', 'string', 'min:3', 'max:50'],
            'longitude' => ['required', 'string', 'min:3', 'max:50'],
            'latitude' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }


    public function validated($key = null, $default = null)
    {
        return [
            'governorate' => $this->governorate,
            'region' => $this->region,
            'street' => $this->street,
            'building_number' => $this->buildingNumber,
            'details' => $this->details,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
}

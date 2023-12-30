<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptDeliveryOrder extends FormRequest
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
            'driversId' => ['required', 'array'] // enum
        ];
    }


    // public function validated($key = null, $default = null)
    // {
    //     return [
    //         'driver_id' => $this->driverId,
    //     ];
    // }
}

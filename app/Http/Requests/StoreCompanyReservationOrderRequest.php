<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyReservationOrderRequest extends FormRequest
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
            'totalJourneySeatNum' => ['required', 'integer'], // max number of remaining seat
            'seatNumber' => ['required', 'integer'], // validation on seat
        ];
    }


    public function validatedReservationOrder($key = null, $default = null)
    {
        return [
            'total_journey_seat_num' => $this->totalJourneySeatNum,
        ];
    }


    public function validatedCompanySeatDetails($key = null, $default = null)
    {
        return [
            'seat_number' => $this->seatNumber
        ];
    }
}

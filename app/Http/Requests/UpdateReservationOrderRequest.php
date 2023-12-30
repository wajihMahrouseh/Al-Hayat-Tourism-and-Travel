<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationOrderRequest extends FormRequest
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
            'seatDetails' => ['required', 'array'],
            'seatDetails.*.firstName' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.lastName' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.fatherName' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.motherName' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.placeAndBirthDate' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.nationalNumber' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.phone' => ['required', 'string', 'min:3', 'max:50'],
            'seatDetails.*.email' => ['required', 'email', 'min:3', 'max:50'],
            'seatDetails.*.frontId' => ['required', 'image'],
            'seatDetails.*.backId' => ['required', 'image'],
            'seatDetails.*.seatNumber' => ['required', 'integer'], // validation on seat
        ];
    }


    public function validatedReservationOrder($key = null, $default = null)
    {
        return [
            'total_journey_seat_num' => $this->totalJourneySeatNum,
        ];
    }


    public function validatedIndividualSeatDetails($key = null, $default = null)
    {
        $data = [];
        foreach ($this->seatDetails as $seatDetails) {
            $data[] = [
                'first_name' => $seatDetails['firstName'],
                'last_name' => $seatDetails['lastName'],
                'father_name' => $seatDetails['fatherName'],
                'mother_name' => $seatDetails['motherName'],
                'place_and_birth_date' => $seatDetails['placeAndBirthDate'],
                'national_number' => $seatDetails['nationalNumber'],
                'phone' => $seatDetails['phone'],
                'email' => $seatDetails['email'],
                'seat_number' => $seatDetails['seatNumber'],
            ];
        }
        return $data;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJourneyRequest extends FormRequest
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
            'startDate' => ['required', 'date', 'date_format:Y-m-d'],
            'duration' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'description' => ['required', 'string'],

            'rows' => ['required', 'integer'],
            'rightColumns' => ['required', 'integer'],
            'leftColumns' => ['required', 'integer'],
            'backColumns' => ['required', 'integer'],
        ];
    }


    public function validated($key = null, $default = null): array
    {
        return [
            'start_date' => $this->startDate,
            'duration' => $this->duration,
            'price' => $this->price,
            'description' => $this->description,

            'rows' => $this->rows,
            'right_columns' => $this->rightColumns,
            'left_columns' => $this->leftColumns,
            'back_columns' => $this->backColumns,
        ];
    }
}

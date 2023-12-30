<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'description' => ['required', 'string', 'min:3', 'max:50'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'title' => $this->title,
            'date' => $this->date,
            'description' => $this->description,
        ];
    }
}

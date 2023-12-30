<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'whoUs' => ['required', 'string', 'min:3', 'max:50'],
            'phone' => ['required', 'string', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'min:3', 'max:50'],
            'facebook' => ['required', 'string', 'min:3', 'max:50'],
            'website' => ['required', 'string', 'min:3', 'max:50'],
            'address' => ['required', 'string', 'min:3', 'max:50'],
            'workTime' => ['required', 'string', 'min:3', 'max:50'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'who_us' => $this->whoUs,
            'phone' => $this->phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'website' => $this->website,
            'address' => $this->address,
            'work_time' => $this->workTime,
        ];
    }
}

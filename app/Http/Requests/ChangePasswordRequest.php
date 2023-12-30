<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:3', 'max:50'],
            'confirmPassword' => ['required', 'string', 'min:3', 'max:50', 'same:password'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function validated($key = null, $default = null)
    {
        return [
            'password' => Hash::make($this->password),
        ];
    }
}

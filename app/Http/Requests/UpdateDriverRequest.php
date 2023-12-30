<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverRequest extends FormRequest
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
        $id = $this->route('driver')->user->id;

        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'phone' => ['required', 'string', 'min:3', 'max:50'],
            'carNumber' => ['required', 'string', 'min:3', 'max:50'],
            'carColor' => ['required', 'string', 'min:3', 'max:50'],
            'username' => ['required', 'string', 'min:3', 'max:50', Rule::unique('users', 'username')->ignore($id)],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'driverData' => [
                'phone' => $this->phone,
                'car_number' => $this->carNumber,
                'car_color' => $this->carColor,
            ],
            'userData' => [
                'name' => $this->name,
                'username' => $this->username,
                'password' => Hash::make($this->password),
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email',  'max:250'],
            'password' => ['required', 'min:8', 'confirmed', 'max:20'],
            'password_confirmation' => ['required', 'min:8', 'max:20']
        ];
    }
}

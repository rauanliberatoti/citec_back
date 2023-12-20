<?php

namespace App\Http\Requests;

use App\Rules\ValidateCpfIsUsed;
use App\Rules\ValidateEmailFromAuditor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAuditorRequest extends FormRequest
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
            'cellphone' => ['max:20'],
            'cpf' => ['required', 'string', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:250'],
            'name' => ['required', 'string', 'max:250'],
            'organization' => ['required', 'string', 'max:250'],
            'password' => ['string', 'min:8', 'confirmed', 'max:250'],
            'password_confirmation' => ['string', 'max:250'],
            'register_number' => ['required', 'numeric'],
            'telephone' => ['max:20'],
            'change_citizen_access_level' => ['boolean']
        ];
    }
}

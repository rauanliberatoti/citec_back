<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:250'],
            'address' => ['required', 'string', 'max:250'],
            'cellphone' => ['max:20'],
            'telephone' => ['max:20'],
            'city' => ['required', 'string', 'max:250'],
            'complement' => ['max:250'],
            'cpf' => ['string', 'max:14'],
            'email' => ['string', 'email', 'max:250'],
            'neighborhood' => ['required', 'string', 'max:250'],
            'number' => ['required', 'max:250'],
            'state' => ['required', 'string', 'max:250'],
            'zipCode' => ['required', 'string', 'max:250'],
        ];
    }
}

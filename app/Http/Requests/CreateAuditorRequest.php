<?php

namespace App\Http\Requests;

use App\Constants\UserConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAuditorRequest extends FormRequest
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
            'cpf' => ['required', 'string', 'max:14', Rule::unique('users')->where(function ($query) {
                $query->where('access_level', UserConstant::GENERAL_AUDITOR)
                ->orWhere('access_level', UserConstant::AUDITOR);
            })],
            'email' => ['required', 'string', 'email', 'max:250', 'unique:users'],
            'name' => ['required', 'string', 'max:250'],
            'organization' => ['required', 'string', 'max:250'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:250'],
            'password_confirmation' => ['required', 'string', 'max:250'],
            'register_number' => ['required', 'numeric'],
            'telephone' => ['max:20'],
            'change_citizen_access_level' => ['boolean']
        ];
    }

    public function messages()
    {
        return ['cpf.unique' => 'CPF já cadastrado como um ouvidor e não é possível realizar cadastro. Por favor, verifique e tente novamente.'];
    }
}

<?php

namespace App\Http\Controllers\Validate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ValidateCpfController extends Controller
{
    public function __construct()
    {
    }

    public function control(Request $request)
    {
        $data = $request->validate(['cpf' => 'string | max:11 | required']);
        $user = User::query()->where('cpf', '=', $data['cpf'])->first();
        if ($user)
            throw new ModelNotFoundException('CPF já cadastrado no sistema. Verifique e tente novamente.');
        return $this->send();
    }
}

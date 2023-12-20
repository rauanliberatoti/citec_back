<?php

namespace App\Http\Controllers\Validate;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ValidateEmailController extends Controller
{
    public function __construct()
    {
    }

    public function control(Request $request)
    {
        $data = $request->validate(['email' => 'string | max:250 | required |email']);
        $user = User::query()->where('email', '=', $data['email'])->first();
        if ($user)
            throw new ModelNotFoundException('Este e-mail já está sendo utilizado. Verifique e tente novamente.');
        return $this->send();
    }
}

<?php

namespace App\Http\Controllers;

use App\DTO\ForgotPasswordDTO;
use App\Services\Password\ForgotPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __construct(
        protected ForgotPasswordService $forgotPasswordService
    ) {
    }
    public function __invoke(Request $request)
    {
        $request = $request->validate(['cpf' => ['required','string','max:14']]);
        $data = new ForgotPasswordDTO($request['cpf']);

        $userEmail = $this->forgotPasswordService->handle($data);
        return $this->send($userEmail);
    }
}

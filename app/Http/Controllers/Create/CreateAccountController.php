<?php

namespace App\Http\Controllers\Create;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Services\Create\CreateAccountService;

class CreateAccountController extends Controller
{
    public function __construct(
        private CreateAccountService $createAccountService
    )
    {
    }

    public function control(CreateAccountRequest $request)
    {
        $data = $request->validated();
        $this->createAccountService->handle($data);
        return $this->send();
    }
}

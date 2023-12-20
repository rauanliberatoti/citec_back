<?php

namespace App\Http\Controllers;

use App\DTO\ChangePasswordDTO;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\Password\ChangePasswordService;

class ChangePasswordController extends Controller
{
    public function __construct(
        protected ChangePasswordService $changePasswordService
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(ChangePasswordRequest $request)
    {
        $request = $request->validated();
        $data = new ChangePasswordDTO(...$request);
        $this->changePasswordService->handle($data);
        return $this->send();
    }
}

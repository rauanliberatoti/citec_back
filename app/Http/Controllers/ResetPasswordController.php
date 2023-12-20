<?php

namespace App\Http\Controllers;

use App\DTO\ResetPasswordDTO;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Password\ResetPasswordService;

class ResetPasswordController extends Controller
{
    public function __construct(
        protected ResetPasswordService $resetPasswordService
    ) {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $request = $request->validated();
        $data = new ResetPasswordDTO(...$request);

        $this->resetPasswordService->handle($data);
        return $this->emptySend();
    }
}

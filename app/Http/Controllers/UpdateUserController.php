<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Services\User\EditUserService;

class UpdateUserController extends Controller
{
    public function __construct(
        protected EditUserService $editUserService,
        protected User $user
    ){

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(EditUserRequest $request)
    {
        $request = $request->validated();
        $data = new UserDTO($this->user->getAuthUser()->id,...$request);
        return $this->send($this->editUserService->handle($data));
    }
}

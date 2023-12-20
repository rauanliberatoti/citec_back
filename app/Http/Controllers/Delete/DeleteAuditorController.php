<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interface\IUserRepository;
use Illuminate\Http\Request;

class DeleteAuditorController extends Controller
{
    public function __construct(
        protected IUserRepository $userRepository,
        protected User $user
    ) {

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        if ($this->user->getAuthUser()->id == $id)
            return;
        $this->userRepository->deleteUser($id);
    }
}

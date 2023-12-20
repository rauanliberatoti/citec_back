<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use App\Repositories\Interface\IUserRepository;
use Illuminate\Http\Request;

class ShowAuditorController extends Controller
{

    public function __construct(
        protected IUserRepository $userRepository
    ) {

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int|string $id)
    {
        $user = $this->userRepository->getUserWithOrganization($id);
        return $this->send($user);
    }
}

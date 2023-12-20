<?php
namespace App\Services\Password;

use App\DTO\ChangePasswordDTO;
use App\Models\User;
use App\Repositories\Interface\IPasswordRepository;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    public function __construct(
        protected IPasswordRepository $passwordRepository,
        protected User $user
    ) {
    }
    public function handle(ChangePasswordDTO $data)
    {
        return $this->passwordRepository->changePassword($data->password, $this->user->getAuthUser()->id);
    }
}

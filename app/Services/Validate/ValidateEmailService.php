<?php
namespace App\Services\Validate;

use App\Repositories\Interface\IUserRepository;

class ValidateEmailService
{
    public function __construct(
        protected IUserRepository $userRepository
    ) {

    }
    public function validateEmailAlreadyUsedByAuditorOrGeneralAuditor($id, $email)
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (!$user || $user->id == $id) {
            return;
        }
        throw new \DomainException('O campo email já está sendo utilizado.');
    }
}

<?php
namespace App\Services\Validate;

use App\Constants\UserConstant;
use App\Repositories\Interface\IUserRepository;

class ValidateCpfService
{

    public function __construct(
        protected IUserRepository $userRepository
    ) {

    }

    public function validateCpfAlreadyUsedByAuditorOrGeneralAuditor(string $id, string $cpf)
    {
        $user = $this->userRepository->getUserByCpf($cpf);

        if (!$user || $user->id == $id) return;

        $value = $this->userRepository->getUserAccessLevelByCpf($cpf);

        if ($value == UserConstant::AUDITOR || $value == UserConstant::GENERAL_AUDITOR) {
            throw new \DomainException('CPF já cadastrado como um ouvidor e não é possível realizar cadastro. Por favor, verifique e tente novamente.');
        }
    }
}

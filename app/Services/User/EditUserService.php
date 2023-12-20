<?php
namespace App\Services\User;

use App\DTO\UserDTO;
use App\Repositories\Interface\IUserRepository;
use Illuminate\Support\Facades\Auth;

class EditUserService
{

    public function __construct(
        protected IUserRepository $userRepository
    ) {
    }
    public function handle(UserDTO $data)
    {
        $userCpf = $this->userRepository->getUserByCpf($data->cpf);
        if ($userCpf && $userCpf->id != $data->id)
            throw new \DomainException('CPF já cadastrado no sistema. Verifique e tente novamente.');

        $userEmail = $this->userRepository->getUserByEmail($data->email);
        if ($userEmail && $userEmail->id != $data->id)
            throw new \DomainException('E-mail já cadastrado no sistema. Verifique e tente novamente.');

        $this->userRepository->updateUser($data);
        return $this->userRepository->getUser($data->id);
    }
}

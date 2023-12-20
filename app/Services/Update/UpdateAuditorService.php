<?php

namespace App\Services\Update;

use App\Constants\UserConstant;
use App\DTO\UpdateAuditorDTO;
use App\Repositories\Interface\IOrganization;
use App\Repositories\Interface\IUserRepository;
use App\Services\Validate\ValidateCpfService;
use App\Services\Validate\ValidateEmailService;

class UpdateAuditorService
{

    public function __construct(
        protected IUserRepository $userRepository,
        protected IOrganization $organizationRepository,
        protected ValidateCpfService $validateCpfService,
        protected ValidateEmailService $validateEmailService
    ) {

    }
    public function handle(UpdateAuditorDTO $data)
    {
        $this->validateCpfService->validateCpfAlreadyUsedByAuditorOrGeneralAuditor($data->id, $data->cpf);
        $this->validateEmailService->validateEmailAlreadyUsedByAuditorOrGeneralAuditor($data->id, $data->email);

        if (!$data->change_citizen_access_level) {
            $userAccessLevel = $this->userRepository->getUserAccessLevelByCpf($data->cpf);
            if ($userAccessLevel === UserConstant::CITIZEN) {
                return [
                    "citizen_registered" => "Este CPF já está cadastrado como cidadão. Deseja cadastrá-lo como ouvidor? Essa ação não poderá ser desfeita e o acesso como cidadão será perdido."
                ];
            }
        }

        $user = $this->userRepository->getUserByCpf($data->cpf);

        if ($user && $user->id != $data->id) {
            $this->userRepository->deleteUser($user->id);
        }

        $organization = $this->organizationRepository->getOrganizationByName($data->organization);
        $data->organization = $organization->id;

        $this->userRepository->updateAuditorById($data, $data->id);
        $this->userRepository->updateAuditorPassword($data->id, $data->password);
        return $this->userRepository->getUserWithOrganization($data->id);
    }
}

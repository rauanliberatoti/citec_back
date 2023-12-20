<?php

namespace App\Services\Create;

use App\Constants\UserConstant;
use App\DTO\AuditorDTO;
use App\Repositories\Interface\ICreateRepository;
use App\Repositories\Interface\IOrganization;
use App\Repositories\Interface\IUserRepository;

class CreateAuditorService
{
    public function __construct(
        protected IUserRepository $userRepository,
        protected IOrganization $organizationRepository
    ) {

    }
    public function handle(AuditorDTO $data)
    {
        if (!$data->change_citizen_access_level) {
            $userAccessLevel = $this->userRepository->getUserAccessLevelByCpf($data->cpf);
            if ($userAccessLevel === UserConstant::CITIZEN) {
                return [
                    "citizen_registered" => "Este CPF já está cadastrado como cidadão. Deseja cadastrá-lo como ouvidor? Essa ação não poderá ser desfeita e o acesso como cidadão será perdido."
                ];
            }
        }
        $organization = $this->organizationRepository->getOrganizationByName($data->organization);
        $data->organization = $organization->id;

        return $this->userRepository->updateOrCreateAuditor($data);
    }
}

<?php

namespace App\DTO;
use App\Utils\ClearString;

class UpdateAuditorDTO
{
    public function __construct(
        public int $id,
        public string $cpf,
        public string $email,
        public string $name,
        public string $organization,
        public int $register_number,
        public ?string $password = null,
        public ?string $password_confirmation = null,
        public ?bool $change_citizen_access_level = false,
        public ?string $telephone = '',
        public ?string $cellphone = '',
    )
    {
        $clearString = new ClearString();
        $this->cpf = $clearString->clear($cpf);
        $this->cellphone = $clearString->clear($cellphone);
        $this->telephone = $clearString->clear($telephone);
    }
}

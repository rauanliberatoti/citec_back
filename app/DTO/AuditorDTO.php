<?php

namespace App\DTO;
use App\Utils\ClearString;

class AuditorDTO
{
    public function __construct(
        public string $cpf,
        public string $email,
        public string $name,
        public string $organization,
        public string $password,
        public string $password_confirmation,
        public int $register_number,
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

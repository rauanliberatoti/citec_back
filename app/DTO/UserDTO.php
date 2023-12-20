<?php
namespace App\DTO;

use App\Utils\ClearString;

class UserDTO
{
    public function __construct(
        public ?string $id = null,
        public ?string $complement = null,
        public ?string $cellphone = null,
        public ?string $telephone = null,
        public string $cpf,
        public string $email,
        public string $name,
        public string $zipCode,
        public string $state,
        public string $city,
        public string $neighborhood,
        public string $address,
        public string $number,
    ) {
        $clearString = new ClearString();
        $this->cpf = $clearString->clear($cpf);
        $this->cellphone = $clearString->clear($cellphone);
        $this->zipCode = $clearString->clear($zipCode);
    }
}

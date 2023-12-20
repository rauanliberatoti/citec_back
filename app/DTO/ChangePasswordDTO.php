<?php
namespace App\DTO;

class ChangePasswordDTO
{
    public function __construct(
        public string $current_password,
        public string $password,
        public string $password_confirmation
    ) {

    }
}

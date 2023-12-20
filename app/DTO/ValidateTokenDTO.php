<?php
namespace App\DTO;

class ValidateTokenDTO
{
    public function __construct(
        public string $token,
        public string $email,
    ) {
    }
}

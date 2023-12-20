<?php
namespace App\DTO;

class ForgotPasswordDTO
{
    public function __construct(public string $cpf)
    {
    }
}

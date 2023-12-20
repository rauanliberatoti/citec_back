<?php
namespace App\Repositories\Interface;
interface IPasswordRepository
{
    public function saveToken(string $email, string $token);

    public function validateResetToken(string $token);

    public function changePassword(string $password, int $id);
}


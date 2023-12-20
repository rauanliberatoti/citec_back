<?php

namespace App\Services\Password;

use App\DTO\ForgotPasswordDTO;
use App\Mail\User\ResetPasswordMail;
use App\Repositories\Interface\IPasswordRepository;
use App\Repositories\Interface\IUserRepository;
use DomainException;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordService
{
    public function __construct(
        protected IPasswordRepository $passwordRepository,
        protected IUserRepository $userRepository
    ) {
    }

    public function handle(ForgotPasswordDTO $data)
    {
        $token = Str::random(64);
        $user = $this->userRepository->getUserByCpf($data->cpf);
        if (!$user)
            throw new DomainException('Usuário não encontrado');
        $this->passwordRepository->saveToken($user->email, $token);

        $tokenUrl = env('APP_URL') . '/autenticacao/resetar-senha/' . $token . '?email=' . $user->email;
        $appName = env('APP_NAME');

        Mail::to($user->email)->send(new ResetPasswordMail($user, $tokenUrl, $appName));

        $result = [
            "email" => $this->getInitialCharsFromEmail($user->email),
            "domain" => $this->getDomainFromEmail($user->email)
        ];
        return $result;
    }
    public function getInitialCharsFromEmail(string $email)
    {
        $initialChars = substr($email, 0, 4);
        return $initialChars;
    }
    public function getDomainFromEmail(string $email)
    {
        $domain = substr($email, strpos($email, '@') + 1);
        return $domain;
    }
}

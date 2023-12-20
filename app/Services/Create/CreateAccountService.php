<?php

namespace App\Services\Create;
use App\Repositories\Interface\ICreateRepository;
use App\Utils\ClearString;

class CreateAccountService
{
    public function __construct(
        private ICreateRepository $createRepository,
        private ClearString $clearString
    ){

    }
    public function handle(array $data)
    {
        return $this->createRepository->createUser($data);
    }
}

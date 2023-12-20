<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interface\ICreateRepository;
use App\Utils\ClearString;
use Illuminate\Support\Facades\Hash;

class CreateRepository implements ICreateRepository
{

    public function __construct(
        private ClearString $clearString
    ) {
    }
    public function createUser(array $data)
    {
        User::query()->create([
            "name" => $data["name"],
            "email" => $data["email"],
            "cpf" => $this->clearString->clear($data["cpf"]),
            "access_level" => 0,
            "password" => Hash::make($data['password']),
            "address" => $data["address"],
            "cellphone" => $this->clearString->clear($data["cellphone"]),
            "complement" => $data["complement"] ?? null,
            "number" => $data["number"],
            "neighborhood" => $data["neighborhood"],
            "zipCode" => $this->clearString->clear($data["zipCode"]),
            "city" => $data["city"],
            "state" => $data["state"],
        ]);
    }
}


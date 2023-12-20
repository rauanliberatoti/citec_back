<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Collection;

interface ICreateRepository
{
    public function createUser(array $data);
}

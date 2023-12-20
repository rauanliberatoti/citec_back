<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Collection;

interface ICityRepository
{
    public function listCitiesByStateAcronym(string $acronym): Collection;
}

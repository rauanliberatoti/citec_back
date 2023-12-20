<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interface\ICityRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CityRepository implements ICityRepository
{
    public function listCitiesByStateAcronym(string $acronym, $withs = ['state']): Collection
    {
        return City::query()
            ->join('states as s', 's.id', 'cities.state_id')
            ->where('s.acronym', 'ilike', $acronym)
            ->orderBy('cities.name')
            ->orderBy('s.name')
            ->get('cities.*');
    }
}

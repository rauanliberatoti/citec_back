<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\ICityRepository;
use Illuminate\Http\Request;

class ListCitiesByStateController extends Controller
{
    public function __construct(
        private ICityRepository $cityRepository
    ) {
    }

    public function control($acronym)
    {
        return $this->send(
            $this->cityRepository->listCitiesByStateAcronym($acronym)
        );
    }
}

<?php

namespace App\Repositories;
use App\Models\Organization;
use App\Repositories\Interface\IOrganization;

class OrganizationRepository implements IOrganization{
    public function getOrganizationByName(string $name){
        $organization = Organization::where('name', $name)->first();
        return $organization;
    }
}

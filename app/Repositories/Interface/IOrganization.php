<?php

namespace App\Repositories\Interface;


interface IOrganization
{
    public function getOrganizationByName(string $name);
}

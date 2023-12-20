<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function __construct()
    {
    }

    public function control()
    {
        return $this->send(Config::query()->select('color','image_url')->first());
    }
}

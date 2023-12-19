<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Abstracts\LocationController;
use App\Services\DatabaseCityService;
use App\Services\RajaOngkirCityService;

class CityController extends LocationController
{
    public function __construct()
    {
        parent::__construct(new DatabaseCityService(), new RajaOngkirCityService());
    }
}

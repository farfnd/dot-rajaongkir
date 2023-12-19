<?php

namespace App\Services;

use App\Models\City;
use App\Services\Abstracts\DatabaseLocationService;

class DatabaseCityService extends DatabaseLocationService
{
    protected function getModel(): City
    {
        return new City();
    }
}

<?php

namespace App\Services;

use App\Services\Abstracts\RajaOngkirLocationService;

class RajaOngkirCityService extends RajaOngkirLocationService
{
    protected function getPath(): string
    {
        return 'city';
    }
}

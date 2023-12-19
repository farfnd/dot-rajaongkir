<?php

namespace App\Services;

use App\Services\Abstracts\RajaOngkirLocationService;

class RajaOngkirProvinceService extends RajaOngkirLocationService
{
    protected function getPath(): string
    {
        return 'province';
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Abstracts\LocationController;
use App\Services\DatabaseProvinceService;
use App\Services\RajaOngkirProvinceService;

class ProvinceController extends LocationController
{
    public function __construct()
    {
        parent::__construct(new DatabaseProvinceService(), new RajaOngkirProvinceService());
    }
}

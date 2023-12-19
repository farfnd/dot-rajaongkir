<?php

namespace App\Services;

use App\Models\Province;
use App\Services\Abstracts\DatabaseLocationService;

class DatabaseProvinceService extends DatabaseLocationService
{
    protected function getModel(): Province
    {
        return new Province();
    }
}

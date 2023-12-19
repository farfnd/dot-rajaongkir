<?php

namespace App\Services\Abstracts;

use App\Contracts\LocationServiceInterface;
use App\Models\Province;
use App\Models\City;

abstract class DatabaseLocationService implements LocationServiceInterface
{
    abstract protected function getModel(): Province|City;

    public function getAll()
    {
        return $this->getModel()::all();
    }

    public function getById($id)
    {
        return $this->getModel()::find($id);
    }
}

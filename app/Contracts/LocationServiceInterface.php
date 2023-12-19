<?php

namespace App\Contracts;

interface LocationServiceInterface
{
    public function getAll();

    public function getById($id);
}

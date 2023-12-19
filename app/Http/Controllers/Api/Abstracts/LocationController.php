<?php

namespace App\Http\Controllers\Api\Abstracts;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponseTrait;
use App\Contracts\LocationServiceInterface;
use App\Services\Abstracts\DatabaseLocationService;
use App\Services\Abstracts\RajaOngkirLocationService;
use Illuminate\Http\Request;

abstract class LocationController extends Controller
{
    use ApiResponseTrait;

    protected $locationService;

    public function __construct(DatabaseLocationService $dbService, RajaOngkirLocationService $rajaOngkirService)
    {
        if (env('USE_RAJAONGKIR_API') == 'true') {
            $this->locationService = $rajaOngkirService;
        } else {
            $this->locationService = $dbService;
        }
    }

    public function search(Request $request)
    {
        $id = $request->query('id');

        if ($id) {
            return $this->show($id);
        }

        return $this->index();
    }

    public function index()
    {
        $data = $this->locationService->getAll();

        return $this->sendSuccess($data, 'All data fetched');
    }

    public function show($id)
    {
        $data = $this->locationService->getById($id);

        if ($data) {
            return $this->sendSuccess($data, 'Data found');
        } else {
            return $this->sendNotFound('Data not found');
        }
    }
}

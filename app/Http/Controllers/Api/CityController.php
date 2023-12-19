<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponseTrait;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponseTrait;

    /**
     * Retrieve city(ies) data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $cityId = $request->query('id');

        if ($cityId) {
            return $this->show($cityId);
        }
        return $this->index();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cities = City::all();

        return $this->sendSuccess($cities, 'All cities fetched');
    }

    /**
     * Display the specified resource.
     *
     * @param $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($cityId)
    {
        $city = City::find($cityId);

        if ($city) {
            return $this->sendSuccess($city, 'City found');
        } else {
            return $this->sendNotFound('City not found');
        }
    }
}

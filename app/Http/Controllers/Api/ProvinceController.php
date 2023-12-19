<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponseTrait;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    use ApiResponseTrait;

    /**
     * Retrieve province(s) data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $provinceId = $request->query('id');

        if ($provinceId) {
            return $this->show($provinceId);
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
        $provinces = Province::all();

        return $this->sendSuccess($provinces, 'All provinces fetched');
    }

    /**
     * Display the specified resource.
     *
     * @param $provinceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($provinceId)
    {
        $province = Province::find($provinceId);

        if ($province) {
            return $this->sendSuccess($province, 'Province found');
        } else {
            return $this->sendNotFound('Province not found');
        }
    }
}

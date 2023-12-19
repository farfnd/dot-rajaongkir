<?php

namespace App\Http\Services;

use App\Models\Province;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    public function fetchProvinces()
    {
        $response = Http::get(env('RAJAONGKIR_API_URL') . '/province', [
            'key' => env('RAJAONGKIR_API_KEY'),
        ]);

        if ($response->successful()) {
            $provinces = $response->json()['rajaongkir']['results'];

            foreach ($provinces as $provinceData) {
                Province::updateOrCreate([
                    'province_id' => $provinceData['province_id'],
                ], [
                    'province' => $provinceData['province'],
                ]);
            }

            return count($provinces);
        }

        return 0;
    }

    public function fetchCities()
    {
        $response = Http::get(env('RAJAONGKIR_API_URL') . '/city', [
            'key' => env('RAJAONGKIR_API_KEY'),
        ]);

        if ($response->successful()) {
            $cities = $response->json()['rajaongkir']['results'];

            foreach ($cities as $cityData) {
                City::updateOrCreate([
                    'city_id' => $cityData['city_id'],
                ], [
                    'province_id' => $cityData['province_id'],
                    'province' => $cityData['province'],
                    'city_name' => $cityData['city_name'],
                    'type' => $cityData['type'],
                    'postal_code' => $cityData['postal_code'],
                ]);
            }

            return count($cities);
        }

        return 0;
    }
}

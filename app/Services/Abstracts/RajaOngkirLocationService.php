<?php

namespace App\Services\Abstracts;

use App\Contracts\LocationServiceInterface;
use Illuminate\Support\Facades\Http;

abstract class RajaOngkirLocationService implements LocationServiceInterface
{
    abstract protected function getPath(): string;

    protected function getUrl(): string
    {
        return env('RAJAONGKIR_API_URL') . '/' . $this->getPath();
    }

    public function getAll()
    {
        $response = Http::get($this->getUrl(), [
            'key' => env('RAJAONGKIR_API_KEY'),
        ]);

        return $this->returnData($response, []);
    }

    public function getById($id)
    {
        $response = Http::get($this->getUrl(), [
            'id' => $id,
            'key' => env('RAJAONGKIR_API_KEY'),
        ]);

        return $this->returnData($response, null);
    }

    private function returnData($response, $onEmpty)
    {
        if ($response->successful()) {
            return $response->json()['rajaongkir']['results'];
        }

        return $onEmpty;
    }
}

<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = Province::all();

        foreach ($provinces as $province) {
            City::factory(10)->create([
                'province_id' => $province->province_id,
                'province' => $province->province,
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $province = Province::inRandomOrder()->first();
        return [
            'province_id' => $province->province_id,
            'province' => $province->province,
            'city_name' => $this->faker->city,
            'type' => $this->faker->randomElement(['Kabupaten', 'Kota']),
            'postal_code' => $this->faker->postcode,
        ];
    }
}

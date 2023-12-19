<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\City;
use App\Models\Province;
use App\Models\User;

class CityTest extends TestCase
{
    use DatabaseMigrations;

    protected $url = '/api/search/cities';

    protected $token;

    protected $province;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->token = $user->createToken('testToken')->plainTextToken;
        $this->province = Province::factory()->create();
    }

    public function test_get_all_cities_from_db()
    {
        config(['rajaongkir.enabled' => false]);
        City::factory(5)->create([
            'province_id' => $this->province->province_id,
            'province' => $this->province->province,
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url);
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    public function test_get_single_city_from_db()
    {
        config(['rajaongkir.enabled' => false]);
        $city = City::factory()->create([
            'province_id' => $this->province->province_id,
            'province' => $this->province->province,
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "?id={$city->city_id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['city_id' => $city->city_id]);
    }

    public function test_get_all_cities_from_rajaongkir_api()
    {
        config(['rajaongkir.enabled' => true]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url);
        $response->assertStatus(200)
            ->assertJsonCount(501, 'data');
    }

    public function test_get_single_city_from_rajaongkir_api()
    {
        config(['rajaongkir.enabled' => true]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "?id=1");
        $response->assertStatus(200)
            ->assertJsonFragment([
                'type' => 'Kabupaten',
                'city_name' => 'Aceh Barat'
            ]);
    }
}

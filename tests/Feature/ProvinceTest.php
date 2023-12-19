<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Province;
use App\Models\User;

class ProvinceTest extends TestCase
{
    use DatabaseMigrations;

    protected $url = '/api/search/provinces';
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->token = $user->createToken('testToken')->plainTextToken;
    }

    public function test_get_all_provinces_from_db()
    {
        config(['rajaongkir.enabled' => false]);
        Province::factory()->count(5)->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url);
        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    public function test_get_single_province_from_db()
    {
        config(['rajaongkir.enabled' => false]);
        $province = Province::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "?id={$province->province_id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['province_id' => $province->province_id]);
    }

    public function test_get_all_provinces_from_rajaongkir_api()
    {
        config(['rajaongkir.enabled' => true]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url);
        $response->assertStatus(200)
            ->assertJsonCount(34, 'data');
    }

    public function test_get_single_province_from_rajaongkir_api()
    {
        config(['rajaongkir.enabled' => true]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->get($this->url . "?id=1");
        $response->assertStatus(200)
            ->assertJsonFragment(['province' => 'Bali']);
    }
}

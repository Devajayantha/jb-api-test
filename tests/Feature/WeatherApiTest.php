<?php

namespace Tests\Feature;

use App\Infrastructure\OpenWeather\ApiConfig as OpenWeatherApiConfig;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_success_get_api(): void
    {
        $weatherApi = new OpenWeatherApiConfig();

        $response = $weatherApi->fetchData();

        $this->assertIsArray($response);

        $this->assertEquals(200, $response['cod']);
    }
}

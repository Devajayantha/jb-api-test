<?php

namespace App\Services\V1;

use App\Infrastructure\OpenWeather\OpenWeatherApi;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    /**
     * Get the weather detail.
     *
     * @return array<string, mixed>
     */
    public function detail(): array
    {
        return Cache::remember('weather_data', now()->addMinutes(15), function () {
            $weatherApi = new OpenWeatherApi();

            $weatherData = $weatherApi->loadJsonFile();

            return $weatherData;
        });
    }
}

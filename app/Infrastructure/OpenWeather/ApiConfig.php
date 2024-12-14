<?php

namespace App\Infrastructure\OpenWeather;

use Illuminate\Support\Facades\Http;

class ApiConfig
{
    /**
     * Load api key from config.
     *
     * @var string
     */
    protected String $apiKey;

    /**
     * Load api url from config.
     *
     * @var string
     */
    protected String $apiUrl;

    /**
     * Load longitude from config.
     *
     * @var string
     */
    protected String $long;

    /**
     * Load latitude from config.
     *
     * @var string
     */
    protected String $lat;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('openweather.api_key');
        $this->apiUrl = config('openweather.api_url');
        $this->long = config('openweather.longitude');
        $this->lat = config('openweather.latitude');
    }

    /**
     * Fetch data from OpenWeather API.
     *
     * @return array
     * @throws \Exception
     */
    public function fetchData(): array
    {
        $url = $this->apiUrl . '?lat=' .$this->lat.'&lon='. $this->long . '&appid=' . $this->apiKey;

        $response = Http::get($url);
        if ($response->ok()) {
            return $response->json();
        } else {
            throw new \Exception(
                "API Error: Status Code: " . $response->status() .
                " - Message: " . $response->body()
            );
        }
    }
}

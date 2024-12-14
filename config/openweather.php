<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OpenWeatherMap API Key
    |--------------------------------------------------------------------------
    |
    |
    */

    'api_url' => env('OPENWEATHER_URL', 'https://api.openweathermap.org/data/2.5/weather'),

    'api_key' => env('OPENWEATHER_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | OpenWeatherMap Area
    |--------------------------------------------------------------------------
    |
    |
    */

    'latitude' => env('OPENWEATHER_LAT', '-31.953512'),

    'longitude' => env('OPENWEATHER_LON', '115.857048'),
];

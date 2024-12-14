<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WeatherResource;
use App\Services\V1\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Construct.
     *
     * @param \App\Services\V1\WeatherService $service
     */
    public function __construct(protected WeatherService $service)
    {}

    /**
     * Handle the incoming request.
     *
     * @return \App\Http\Resources\Api\V1\WeatherResource
     */
    public function __invoke()
    {
        $weatherJson = $this->service->detail();

        return WeatherResource::make($weatherJson);
    }
}

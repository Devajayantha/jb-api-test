<?php

namespace App\Jobs;

use App\Infrastructure\OpenWeather\OpenWeatherApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherScheduler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(){}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->weatherSaving();
    }

    /**
     * Save the weather data.
     */
    protected function weatherSaving()
    {
        $weatherApi = new OpenWeatherApi();

        $weatherApi->storageFromApi();
    }
}

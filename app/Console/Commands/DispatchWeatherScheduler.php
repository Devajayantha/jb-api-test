<?php

namespace App\Console\Commands;

use App\Jobs\WeatherScheduler;
use Illuminate\Console\Command;

class DispatchWeatherScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dispatch-weather-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch manually WeatherScheduler job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        WeatherScheduler::dispatch();

        $this->info('WeatherScheduler job dispatched successfully!');
    }
}

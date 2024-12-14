<?php

namespace App\Infrastructure\OpenWeather;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OpenWeatherApi
{
    /**
     * @var array The JSON file contents stored as an array.
     */
    protected array $jsonData = [];

    /**
     * @var string
     */
    protected string $filePath = 'app/json/weather_current.json';

    /**
     * Get the JSON data from the storage directory.
     */
    public function storageFromApi()
    {
        $weatherApi = new ApiConfig();

        try {
            $json = $weatherApi->fetchData();

            if ($json == []) {
                Log::warning('No data found in the API response');
                return;
            }

            $this->storeJsonFile(array_merge($json, ['timestamp' => now()->toDateTimeString()]));

            Log::info("Weather data successfully stored at " . now()->toDateTimeString());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle network-related errors (e.g., timeout, DNS issues)
            Log::error('Network error while fetching API data: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle generic errors (e.g., invalid response, unexpected issues)
            Log::error('Error while fetching API data: ' . $e->getMessage());
        }
    }

    /**
     * Store the JSON file in the storage directory.
     */
    public function storeJsonFile(array $data)
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        Storage::put($this->filePath, $json);
    }

    /**
     * Load JSON and convert into array
     *
     * @return array
     */
    public function loadJsonFile(): ?array
    {
        if (!Storage::exists($this->filePath)) {
            Log::warning("File not found: " . $this->filePath);
            return [];
        }

        $json = Storage::get($this->filePath);

        return json_decode($json, true);
    }
}

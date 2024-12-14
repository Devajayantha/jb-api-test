<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'weather' => $this->resource['weather'],
            'main' => $this->resource['main'],
            'wind' => $this->resource['wind'] ?? null,
            'clouds' => $this->resource['clouds'] ?? null,
            'rain' => $this->resource['rain'] ?? null,
            'snow' => $this->resource['snow'] ?? null,
            'created_at' => $this->resource['timestamp'],
        ];
    }
}

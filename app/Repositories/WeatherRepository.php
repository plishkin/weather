<?php

namespace App\Repositories;

use App\Models\Weather;

class WeatherRepository implements WeatherRepositoryInterface
{
    public function findByCityName(string $cityName): ?Weather
    {
        return Weather::where('city_name', $cityName)->first();
    }

    public function updateOrCreateByCityName(string $cityName, array $map): Weather
    {
        return Weather::updateOrCreate(
            ['city_name' => $cityName],
            $map
        );
    }

}

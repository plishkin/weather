<?php

namespace App\Services;

use App\Models\Weather;
use App\Repositories\WeatherRepository;

class WeatherService
{


    public function __construct(
        private readonly WeatherRepository $weatherRepository,
    )
    {
    }

    public function getWeatherByCity(string $cityName): ?Weather
    {
        return $this->weatherRepository->findByCityName($cityName);
    }

    public function saveWeatherByCity(string $cityName, array $map): Weather
    {
        return $this->weatherRepository->updateOrCreateByCityName($cityName, $map);
    }

}

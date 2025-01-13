<?php

namespace App\Services;

use App\Connectors\OpenWeatherMapConnector;
use App\Exceptions\WeatherServerResponseException;
use GuzzleHttp\Exception\GuzzleException;

class WeatherApiService
{

    public function __construct(
        private readonly OpenWeatherMapConnector $openWeatherMapConnector,
    )
    {
    }

    /**
     * @throws GuzzleException
     * @throws WeatherServerResponseException
     */
    public function getOpenWeatherCityWeathers(string $cityName): array
    {
        return $this->openWeatherMapConnector->getCityWeathers($cityName);
    }



}

<?php

namespace app\Connectors;

use GuzzleHttp\Client;
use App\Models\Weather;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\WeatherServerResponseException;

abstract class AbstractWeatherConnector
{
    protected $url = '';

    public function __construct(
        private readonly Client $client,
    )
    {
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @throws GuzzleException
     */
    abstract public function getResponse(array $queryParams = []): ResponseInterface;

    /**
     * @return Weather[]
     * @throws GuzzleException
     * @throws WeatherServerResponseException
     */
    abstract public function getCityWeathers(string $cityName): array;

}

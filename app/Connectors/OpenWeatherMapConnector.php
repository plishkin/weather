<?php

namespace App\Connectors;

use App\Exceptions\WeatherServerResponseException;
use App\Models\Weather;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OpenWeatherMapConnector extends AbstractWeatherConnector
{

    protected $url = 'http://api.openweathermap.org/data/2.5/forecast';

    public function getResponse(array $queryParams = []): ResponseInterface
    {

        $query = [
            'appid' => config('app.openweathermap.app_id'),
            'units' => 'metric',
        ];

        return $this->getClient()->get($this->url, [
            'query' => array_merge($query, $queryParams)
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws WeatherServerResponseException
     */
    public function getCityWeathersResponseJson(string $cityName)
    {
        $queryParams = [
            'q' => $cityName,
        ];
        $response = $this->getResponse($queryParams);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $json = json_decode($content);
        if ($statusCode !== 200) {
            throw new WeatherServerResponseException(
                "Server \"{$this->url}\" failed with status code {$statusCode}",
                $statusCode
            );
        }
        return $json;
    }

    public function getCityWeathers(string $cityName): array
    {
        $json = $this->getCityWeathersResponseJson($cityName);
        return $this->jsonToWeathers($json);
    }

    public function jsonToWeathers(\stdClass $json): array
    {
        $weathers = [];
        $cityName = $json->city?->name;
        if (is_array($json->list)) {
            foreach ($json->list as $item) {
                $weathers[] = $this->itemToWeather($cityName, $item);
            }
        }
        return $weathers;
    }

    public function itemToWeather(string $cityName, \stdClass $item): Weather
    {
        $weather = new Weather();
        $weather->fill([
            'city_name' => $cityName,
            'timestamp_dt' => (int)$item->dt,
            'min_tmp' => (float)$item->main?->temp_min,
            'max_tmp' => (float)$item->main?->temp_max,
            'wind_spd' => (float)$item->wind?->speed,
        ]);
        return $weather;
    }

}

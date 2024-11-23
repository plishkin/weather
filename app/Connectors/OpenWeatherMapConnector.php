<?php

namespace App\Connectors;

use App\Models\Weather;

class OpenWeatherMapConnector
{

    private static string $url = 'http://api.openweathermap.org/data/2.5/forecast';

    public static function getResponse(string $cityName): false|string
    {
        $appId = config('app.openweathermap.app_id');
        $cityNameUrlEncoded = urlencode($cityName);
        $url = self::$url . "?appid={$appId}&units=metric&q={$cityNameUrlEncoded}";
        return @file_get_contents($url);
    }

    public static function getCityWeathers(string $cityName): bool|array
    {
        $content = self::getResponse($cityName);

        $weatherCast = json_decode($content, true);

        $weathers = [];
        $city = $weatherCast['city']['name'];
        if (is_array($weatherCast['list'] ?? false)) {
            foreach ($weatherCast['list'] as $item) {
                $weathers[] = [
                    'city_name' => $city,
                    'timestamp_dt' => $item['dt'],
                    'min_tmp' => $item['main']['temp_min'],
                    'max_tmp' => $item['main']['temp_max'],
                    'wind_spd' => $item['wind']['speed'],
                ];
            }
        }

        return $weathers;
    }

}

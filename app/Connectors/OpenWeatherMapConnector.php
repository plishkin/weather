<?php

namespace App\Connectors;

use App\Models\Weather;

class OpenWeatherMapConnector
{

    private static string $url = 'http://api.openweathermap.org/data/2.5/forecast';

    public static function getCityWeathers(string $cityName): bool|array
    {
        $appId = config('app.openweathermap.app_id');
        $cityNameUrlEncoded = urlencode($cityName);
        $url = self::$url . "?appid={$appId}&units=metric&q={$cityNameUrlEncoded}";
        $content = @file_get_contents($url);

        $weatherCast = json_decode($content, true);

        $weathers = [];
        if (is_array($weatherCast['list'] ?? false)) {
            foreach ($weatherCast['list'] as $item) {
                $weathers[] = [
                    'timestamp_dt' => $item['dt'],
                    'city_name' => $weatherCast['city']['name'],
                    'min_tmp' => $item['main']['temp_min'],
                    'max_tmp' => $item['main']['temp_max'],
                    'wind_spd' => $item['wind']['speed'],
                ];
            }
        }

        return $weathers;
    }

}

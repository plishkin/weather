<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWeatherJob;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function apiAction(Request $request): string
    {
        $cityName = $request->post('cityName') . '';
        ProcessWeatherJob::dispatch($cityName);
        return json_encode([
            'success' => true,
        ]);
    }

    public function dbAction(Request $request): string
    {
        $cityName = $request->post('cityName') . '';

        $weathers = Weather::where('city_name', $cityName)->get()->toArray();

        return json_encode([
            'success' => true,
            'weathers' => $weathers,
        ]);
    }

    public function saveAction(Request $request): string
    {
        $cityName = $request->post('city_name');
        $weather = Weather::updateOrCreate(
            ['city_name' => $cityName],
            [
                'city_name' => $cityName,
                'timestamp_dt' => $request->post('timestamp_dt'),
                'min_tmp' => $request->post('min_tmp'),
                'max_tmp' => $request->post('max_tmp'),
                'wind_spd' => $request->post('wind_spd'),
            ]
        );

        return json_encode([
            'success' => true,
            'weathers' => [$weather->toArray()],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityNameRequest;
use App\Http\Requests\WeatherSaveRequest;
use App\Jobs\ProcessWeatherJob;
use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function apiAction(CityNameRequest $request): string
    {
        $validatedData = $request->validated();
        ProcessWeatherJob::dispatch($validatedData['cityName']);
        return json_encode([
            'success' => true,
        ]);
    }

    public function dbAction(CityNameRequest $request): string
    {
        $validatedData = $request->validated();
        $weathers = Weather::where('city_name', $validatedData['cityName'])->get()->toArray();

        return json_encode([
            'success' => true,
            'weathers' => $weathers,
        ]);
    }

    public function saveAction(WeatherSaveRequest $request): string
    {
        $validatedWeather = $request->validated();
        $weather = Weather::updateOrCreate(
            ['city_name' => $validatedWeather['city_name']],
            $validatedWeather
        );

        return json_encode([
            'success' => true,
            'weathers' => [$weather->toArray()],
        ]);
    }
}

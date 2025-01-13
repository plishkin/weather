<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityNameRequest;
use App\Http\Requests\WeatherSaveRequest;
use App\Jobs\ProcessWeatherJob;
use App\Services\WeatherService;

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

    public function dbAction(CityNameRequest $request, WeatherService $weatherService): string
    {
        $weather = null;
        $error = null;

        try {
            $validatedData = $request->validated();
            $cityName = $validatedData['cityName'];
            $weather = $weatherService->getWeatherByCity($cityName);
            if (!$weather) {
                $error = "Weather for city \"$cityName\" not found";
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return json_encode([
            'success' => !$error,
            'weather' => $weather,
            'error' => $error,
        ]);
    }

    public function saveAction(WeatherSaveRequest $request, WeatherService $weatherService): string
    {
        $weather = null;
        $error = null;

        try {
            $validatedWeather = $request->validated();
            $cityName = $validatedWeather['city_name'];
            $weather = $weatherService->saveWeatherByCity($cityName, $validatedWeather)->toArray();
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return json_encode([
            'success' => !$error,
            'weather' => $weather,
            'error' => $error,
        ]);
    }
}

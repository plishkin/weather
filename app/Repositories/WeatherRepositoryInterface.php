<?php

namespace App\Repositories;

use App\Models\Weather;

interface WeatherRepositoryInterface
{
    public function findByCityName(string $cityName): ?Weather;
    public function updateOrCreateByCityName(string $cityName, array $map): Weather;

}

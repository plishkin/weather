<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\WeatherController;

Route::get('/', [AppController::class, 'index']);

Route::controller(WeatherController::class)->group(function () {
    Route::post('/weather/api', 'apiAction');
    Route::post('/weather/db', 'dbAction');
    Route::post('/weather/save', 'saveAction');
});

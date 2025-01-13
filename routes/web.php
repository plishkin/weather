<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\WeatherController;

Route::get('/', [AppController::class, 'index']);

Route::prefix('weather')->controller(WeatherController::class)->group(function () {
    Route::post('/api', 'apiAction');
    Route::post('/db', 'dbAction');
    Route::post('/save', 'saveAction');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\WeatherController;

Route::get('/', [AppController::class, 'index']);
Route::post('/weather/api', [WeatherController::class, 'apiAction']);
Route::post('/weather/db', [WeatherController::class, 'dbAction']);
Route::post('/weather/save', [WeatherController::class, 'saveAction']);

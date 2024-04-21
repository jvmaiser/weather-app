<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function() {
    Route::get('/cities', [CitiesController::class, 'getCities'])->name('public.cities');
    Route::get('/weather', [WeatherController::class, 'getWeather'])->name('public.weather');
});

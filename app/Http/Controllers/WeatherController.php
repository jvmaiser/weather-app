<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetWeatherRequest;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function __construct(
        protected WeatherService $weatherService,
    ) {
    }

    public function getWeather(GetWeatherRequest $request)
    {
        $response = $this->weatherService->getWeather($request->validated());
        return response()->json($response);
    }
}

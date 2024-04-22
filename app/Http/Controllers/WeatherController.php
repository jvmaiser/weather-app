<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetWeatherRequest;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;

/**
 * Controller responsible for handling requests related to weather.
 * @package App\Http\Controllers\WeatherController
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class WeatherController extends Controller
{
    /**
     * Constructor.
     * @param WeatherService $weatherService
     */
    public function __construct(
        protected WeatherService $weatherService,
    ) {
    }

    /**
     * Get a list of weather based on the provided search criteria.
     * @param GetWeatherRequest $request
     * @return JsonResponse
     */
    public function getWeather(GetWeatherRequest $request): JsonResponse
    {
        $response = $this->weatherService->getWeather($request->validated());
        return response()->json($response);
    }
}

<?php

namespace App\Services;

use App\Services\API\OpenWeatherMapAPIClient;
use Illuminate\Support\Arr;

/**
 * Service responsible for handling weather-related operations.
 * @package App\Services\WeatherService
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class WeatherService
{
    /**
     * OpenWeatherMap API client instance.
     * @var OpenWeatherMapAPIClient
     */
    protected $openWeatherMapAPIClient;

    /**
     * constructor.
     * @param OpenWeatherMapAPIClient $openWeatherMapAPIClient
     */
    public function __construct(OpenWeatherMapAPIClient $openWeatherMapAPIClient)
    {
        $this->openWeatherMapAPIClient = $openWeatherMapAPIClient;
    }

    /**
     * Get weather forecast for the specified city.
     * @param array $city
     * @return array
     */
    public function getWeather(array $city): array
    {
        $response = $this->openWeatherMapAPIClient->get('/forecast', $city);
        $weatherList = Arr::get($response, 'list', []);

        return $this->getClosestTimes($weatherList);
    }

    /**
     * Get the closest future weather forecast times from the current time.
     * @param array $forecast
     * @return array
     */
    private function getClosestTimes(array $forecast): array
    {
        date_default_timezone_set('Asia/Tokyo');
        $currentDateTime = date('Y-m-d H:i:s');

        $filteredLists = [];
        $count = 0;

        foreach ($forecast as $list) {
            if ($list['dt_txt'] > $currentDateTime) {
                $filteredLists[] = $list;
                $count++;
            }

            if ($count >= 5) {
                break;
            }
        }

        return $filteredLists;
    }
}

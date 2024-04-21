<?php

namespace App\Services;

use App\Services\API\OpenWeatherMapAPIClient;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class WeatherService
{
    protected $openWeatherMapAPIClient;

    public function __construct(OpenWeatherMapAPIClient $openWeatherMapAPIClient)
    {
        $this->openWeatherMapAPIClient = $openWeatherMapAPIClient;
    }

    public function getWeather(array $city)
    {
        $response = $this->openWeatherMapAPIClient->get('/forecast', $city);
        $weatherList = Arr::get($response, 'list', []);

        return $this->getClosestTimes($weatherList);
    }

    private function getClosestTimes($forecast)
    {
        date_default_timezone_set('Asia/Tokyo');
        $currentDateTime = date("Y-m-d H:i:s");

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

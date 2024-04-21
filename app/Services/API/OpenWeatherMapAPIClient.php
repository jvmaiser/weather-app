<?php

namespace App\Services\API;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapAPIClient implements APIClientInterface
{
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    protected $openWeatherMapAPIKey;

    public function __construct($openWeatherMapAPIKey)
    {
        $this->openWeatherMapAPIKey = $openWeatherMapAPIKey;
    }

    public function get(string $url, array $params = []): array
    {
        $parameter = array_merge(['appid' => $this->openWeatherMapAPIKey],$params);

        try {
            $response = Http::get($this->baseUrl . $url, $parameter);

            $response->throw();

            return $response->json();
        } catch (RequestException $error) {
            return $error->response->json();
        }
    }
}

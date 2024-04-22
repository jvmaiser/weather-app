<?php

namespace App\Services\API;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * OpenWeatherMap API client implementation.
 * @package App\Services\API\OpenWeatherMapAPIClient
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class OpenWeatherMapAPIClient implements APIClientInterface
{
    /**
     * Base URL for the OpenWeatherMap API.
     * @var string
     */
    protected $baseUrl = 'https://api.openweathermap.org/data/2.5';

    /**
     * OpenWeatherMap API key.
     * @var string
     */
    protected $openWeatherMapAPIKey;

    /**
     * constructor.
     * @param $openWeatherMapAPIKey
     */
    public function __construct(string $openWeatherMapAPIKey)
    {
        $this->openWeatherMapAPIKey = $openWeatherMapAPIKey;
    }

    /**
     * Perform a GET request to the specified URL with optional parameters.
     * @param string $url
     * @param array $params
     * @return array
     */
    public function get(string $url, array $params = []): array
    {
        $parameter = array_merge(['appid' => $this->openWeatherMapAPIKey], $params);

        try {
            $response = Http::get($this->baseUrl . $url, $parameter);

            $response->throw();

            return $response->json();
        } catch (RequestException $error) {
            return $error->response->json();
        }
    }
}

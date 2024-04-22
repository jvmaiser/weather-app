<?php

namespace App\Services\API;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

/**
 * Foursquare API client implementation.
 * @package App\Services\API\FoursquareAPiClient
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class FoursquareAPiClient implements APIClientInterface
{
    /**
     * Default coordinates for Japan.
     */
    CONST JAPAN_COORDINATE = '36.2048,138.2529';

    /**
     * Default place type for searching.
     */
    CONST PLACE_TYPE = 'geo';

    /**
     * Base URL for the Foursquare API.
     * @var string
     */
    protected $baseUrl = 'https://api.foursquare.com/v3';

    /**
     * Foursquare API key.
     * @var string
     */
    protected $foursquareAPIKey;

    /**
     * constructor.
     * @param string $foursquareAPIKey
     */
    public function __construct(string $foursquareAPIKey)
    {
        $this->foursquareAPIKey = $foursquareAPIKey;
    }

    /**
     * Perform a GET request to the specified URL with optional parameters.
     * @param string $url
     * @param array $params
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function get(string $url, array $params = []): array
    {
        $queryParams = [
            'query' => Arr::get($params, 'query'),
            'll'    => self::JAPAN_COORDINATE,
            'types' => self::PLACE_TYPE,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->foursquareAPIKey,
            ])->get($this->baseUrl . $url, $queryParams);

            $response->throw();

            return $response->json();
        } catch (RequestException $error) {
            return $error->response->json();
        }
    }
}

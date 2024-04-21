<?php

namespace App\Services\API;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class FoursquareAPiClient implements APIClientInterface
{
    CONST JAPAN_COORDINATE = '36.2048,138.2529';

    CONST PLACE_TYPE = 'geo';

    protected $baseUrl = 'https://api.foursquare.com/v3';

    protected $foursquareAPIKey;

    public function __construct($foursquareAPIKey)
    {
        $this->foursquareAPIKey = $foursquareAPIKey;
    }

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

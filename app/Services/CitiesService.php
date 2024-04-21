<?php

namespace App\Services;

use App\Services\API\FoursquareAPiClient;
use Illuminate\Support\Arr;

class CitiesService
{
    protected $foursquareClient;

    public function __construct(FoursquareAPiClient $foursquareClient)
    {
        $this->foursquareClient = $foursquareClient;
    }

    public function getCities(array $param): array
    {
        $response = $this->foursquareClient->get('/autocomplete', $param);

        $results = Arr::get($response, 'results', []);
        $cities = [];

        foreach ($results as $result) {
            $cityName = Arr::get($result, 'text.primary');
            $latitude = Arr::get($result, 'geo.center.latitude');
            $longitude = Arr::get($result, 'geo.center.longitude');

            if ($cityName && $latitude && $longitude) {
                $cities[] = [
                    'city'      => $cityName,
                    'latitude'  => $latitude,
                    'longitude' => $longitude,
                ];
            }
        }

        return $cities;
    }
}

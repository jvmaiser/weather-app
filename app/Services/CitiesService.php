<?php

namespace App\Services;

use App\Services\API\FoursquareAPiClient;
use Illuminate\Support\Arr;

/**
 * Service responsible for handling city-related operations.
 * @package App\Services\CitiesService
 * @author Jaybee Satulan <jaybeesatulan@gmail.com>
 */
class CitiesService
{
    /**
     * Foursquare API client instance.
     * @var FoursquareAPiClient
     */
    protected $foursquareClient;

    /**
     * constructor.
     * @param FoursquareAPiClient $foursquareClient
     */
    public function __construct(FoursquareAPiClient $foursquareClient)
    {
        $this->foursquareClient = $foursquareClient;
    }

    /**
     * Get cities based on the provided parameters.
     * @param array $param
     * @return array
     * @throws \Illuminate\Http\Client\ConnectionException
     */
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

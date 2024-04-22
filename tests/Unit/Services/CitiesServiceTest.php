<?php

namespace Tests\Unit\Services;

use App\Services\API\FoursquareAPiClient;
use App\Services\CitiesService;
use Tests\TestCase;
use Mockery;

class CitiesServiceTest extends TestCase
{
    protected $citiesService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->citiesService = new CitiesService($this->mockFoursquareAPiClient());
    }

    protected function mockFoursquareAPiClient()
    {
        $mockApiClient = Mockery::mock(FoursquareAPiClient::class);

        $mockApiClient->shouldReceive('get')
            ->andReturn($this->setCitiesMockData());

        return $mockApiClient;
    }

    public function testGetCitiesReturnsArrayOfCities()
    {
        $cities = $this->citiesService->getCities(['query' => 'Yokohama']);

        $this->assertIsArray($cities);
        $this->assertNotEmpty($cities);
    }

    public function testGetCitiesReturnsCorrectCityData()
    {
        $cities = $this->citiesService->getCities(['query' => 'Yokohama']);

        $this->assertEquals('Yokohama, Kanagawa', $cities[0]['city']);
        $this->assertEquals(35.44778, $cities[0]['latitude']);
        $this->assertEquals(139.6425, $cities[0]['longitude']);
    }

    private function setCitiesMockData()
    {
        return [
            'results' => [
                [
                    'type' => 'geo',
                    'text' => [
                        'primary'   => 'Yokohama, Kanagawa',
                        'secondary' => 'Search for Yokohama, Kanagawa',
                        'highlight' => [
                            [
                                'start'  => 0,
                                'length' => 8,
                            ]
                        ]
                    ],
                    'geo' => [
                        'name'   => 'Yokohama, Kanagawa',
                        'center' => [
                            'latitude' => 35.44778,
                            'longitude' => 139.6425,
                        ],
                        'bounds' => [
                            'ne' => [
                                'latitude'  => 35.672840959202,
                                'longitude' => 139.74687200003,
                            ],
                            'sw' => [
                                'latitude'  => 35.12857911265,
                                'longitude' => 138.9161070028,
                            ]
                        ],
                        'cc'   => 'JP',
                        'type' => 'locality',
                    ]
                ],
            ],
        ];
    }
}

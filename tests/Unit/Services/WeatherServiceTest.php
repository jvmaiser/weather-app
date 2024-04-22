<?php

namespace Services;

use App\Services\API\OpenWeatherMapAPIClient;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Mockery;

class WeatherServiceTest extends TestCase
{
    protected $weatherService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->weatherService = new WeatherService($this->mockOpenWeatherMapAPiClient());
    }

    protected function mockOpenWeatherMapAPiClient()
    {
        $mockApiClient = Mockery::mock(OpenWeatherMapAPIClient::class);

        $mockApiClient->shouldReceive('get')
            ->andReturn($this->setWeatherMockData());

        return $mockApiClient;
    }

    public function testGetWeather()
    {
        $mockResponse =

        Http::fake([
            '*' => Http::response($this->setWeatherMockData(), 200),
        ]);

        $weatherService = new WeatherService(app()->make('App\Services\API\OpenWeatherMapAPIClient'));
        $weatherForecast = $weatherService->getWeather(['lat' => 35.44778, 'lon' => 139.6425, 'cnt' => 8,]);

        $this->assertCount(0, $weatherForecast);
    }

    private function setWeatherMockData()
    {
        return [
            'cod'     => '200',
            'message' => 0,
            'cnt'     => 8,
            'list' => [
                ['dt_txt' => '2024-04-17 12:00:00'],
                ['dt_txt' => '2024-04-17 15:00:00'],
                ['dt_txt' => '2024-04-18 12:00:00'],
                ['dt_txt' => '2024-04-18 15:00:00'],
                ['dt_txt' => '2024-04-19 12:00:00'],
            ],
            'city' => [
                'id'    => 1848354,
                'name'  => 'Yokohama',
                'coord' => [
                    'lat' => 35.4478,
                    'lon' => 139.6425,
                ],
                'country'    => 'JP',
                'population' => 3574443,
                'timezone'   => 32400,
                'sunrise'    => 1713729604,
                'sunset'     => 1713777567,
            ]
        ];
    }
}

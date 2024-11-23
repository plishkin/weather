<?php

namespace Tests\Feature;

use App\Connectors\OpenWeatherMapConnector;
use Tests\TestCase;

class OpenWeatherMapConnectorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_openweathermap_returns_a_successful_response()
    {
        $content = OpenWeatherMapConnector::getResponse('New York');

        $this->assertIsString($content);

        $weathersCast = json_decode($content, true);
        $this->assertIsArray($weathersCast);
        $this->assertNotEmpty($weathersCast);
        $this->assertArrayHasKey('list', $weathersCast);

        $weathers = $weathersCast['list'];
        $this->assertIsArray($weathers);
        $this->assertNotEmpty($weathers);

        $weather = $weathers[0];
        $this->assertIsArray($weather);
        $this->assertNotEmpty($weather);

        $this->assertArrayHasKey('dt', $weather);

        $this->assertArrayHasKey('main', $weather);
        $main = $weather['main'];
        $this->assertIsArray($main);
        $this->assertNotEmpty($main);
        $this->assertArrayHasKey('temp_min', $main);
        $this->assertArrayHasKey('temp_max', $main);

        $this->assertArrayHasKey('wind', $weather);
        $wind = $weather['wind'];
        $this->assertIsArray($wind);
        $this->assertNotEmpty($wind);
        $this->assertArrayHasKey('speed', $wind);

    }

}

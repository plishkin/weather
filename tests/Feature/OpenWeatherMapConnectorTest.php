<?php

namespace Tests\Feature;

use App\Connectors\OpenWeatherMapConnector;
use App\Exceptions\WeatherServerResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Tests\TestCase;

class OpenWeatherMapConnectorTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_open_weather_returns_a_successful_response()
    {
        $connector = $this->app->make(OpenWeatherMapConnector::class);

        try {
            $json = $connector->getCityWeathersResponseJson('New York');
        } catch (WeatherServerResponseException $e) {
            $this->fail($e->getMessage());
        } catch (GuzzleException $e) {
            if ($e instanceof RequestException) {
                $contents = $e->getResponse()?->getBody()?->getContents();
                if ($contents) {
                    $errorJson = json_decode($contents);
                    if ($errorJson->message) {
                        $this->fail($errorJson->message);
                    }
                }
            }
            $this->fail($e->getMessage());
        }

        $this->assertIsObject($json);
        $this->assertInstanceOf(\stdClass::class, $json);

        $this->assertObjectHasProperty('list', $json);

        $list = $json->list;
        $this->assertIsArray($list);
        $this->assertNotEmpty($list);

        $weatherItem = $list[0];
        $this->assertIsObject($weatherItem);
        $this->assertInstanceOf(\stdClass::class, $weatherItem);
        $this->assertObjectHasProperty('dt', $weatherItem);
        $this->assertGreaterThan(0, (int)$weatherItem->dt);


        $this->assertObjectHasProperty('main', $weatherItem);
        $main = $weatherItem->main;
        $this->assertIsObject($main);
        $this->assertInstanceOf(\stdClass::class, $main);
        $this->assertObjectHasProperty('temp_min', $main);
        $this->assertGreaterThan(0, (float)$main->temp_min);
        $this->assertObjectHasProperty('temp_max', $main);
        $this->assertGreaterThan(0, (float)$main->temp_max);

        $this->assertObjectHasProperty('wind', $weatherItem);
        $wind = $weatherItem->wind;
        $this->assertIsObject($wind);
        $this->assertInstanceOf(\stdClass::class, $wind);
        $this->assertObjectHasProperty('speed', $wind);
        $this->assertGreaterThan(0, (float)$wind->speed);

    }

}

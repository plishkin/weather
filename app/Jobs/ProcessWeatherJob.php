<?php

namespace App\Jobs;

use App\Exceptions\WeatherServerResponseException;
use App\Services\WeatherApiService;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\WeatherBroadcastEvent;

class ProcessWeatherJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $cityName,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(WeatherApiService $weatherApiService): void
    {
        $weathers = [];
        $error = null;
        try {
            $weathers = $weatherApiService->getOpenWeatherCityWeathers($this->cityName);
        } catch (WeatherServerResponseException $e) {
            $message = $e->getMessage();
            $error = $message;
            report($e);
        } catch (GuzzleException $e) {
            $message = $e->getMessage();
            if ($e instanceof RequestException) {
                $content = $e->getResponse()?->getBody()?->getContents();
                if ($content) {
                    $json = json_decode($content);
                    $message = $json->message ?: $message;
                }
            }
            $error = $message;
            report($e);
        }
        WeatherBroadcastEvent::dispatch($this->cityName, $weathers, $error ?: null);
    }
}

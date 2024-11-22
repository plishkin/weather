<?php

namespace App\Console\Commands;

use App\Connectors\OpenWeatherMapConnector;
use App\Jobs\ProcessWeatherJob;
use Illuminate\Console\Command;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:weather {cityName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get city weather';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $weathers = OpenWeatherMapConnector::getCityWeathers($this->argument('cityName'));
        ProcessWeatherJob::dispatch($this->argument('cityName'));
    }
}

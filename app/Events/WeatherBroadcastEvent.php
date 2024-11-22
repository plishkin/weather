<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WeatherBroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private array $weathers,
    )
    {
        //
    }

    public function broadcastOn(): Channel
    {
        return new Channel('weather');
    }

    public function broadcastWith(): array
    {
        return [
            'weathers' => $this->weathers,
        ];
    }
}

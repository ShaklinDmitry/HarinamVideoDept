<?php

namespace App\Modules\VideoDepartment\Infrastructure\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     */
    public function __construct(private string $videoName, private \DateTime $recordDate)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}

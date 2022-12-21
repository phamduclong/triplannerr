<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeLikeAndAlertTravelReport implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $numberOfLike;
    public $numberOfAlert;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $numberOfLike, $numberOfAlert)
    {
        //
        $this->userId = $userId;
        $this->numberOfLike = $numberOfLike;
        $this->numberOfAlert = $numberOfAlert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['channel-change-like-and-alert'];
    }
    public function broadcastAs()
    {
        return 'event-change-like-and-alert';
    }
}

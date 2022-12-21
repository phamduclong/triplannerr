<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeUserFollows implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $numberOfFollows;
    public $listUserFollows;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $numberOfFollows, $listUserFollows)
    {
        //
        $this->userId = $userId;
        $this->numberOfFollows = $numberOfFollows;
        $this->listUserFollows = $listUserFollows;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['channel-change-user-follows'];
    }

    public function broadcastAs()
    {
        return 'event-change-user-follows';
    }
}

<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastChatMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $userTo;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $userTo)
    {
      if ($message) {
        $this->message = $message;
        $this->userTo = $userTo;
      }
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['chat-message'];
    }
}

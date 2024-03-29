<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatHasBeenDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;
    public $chat_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $chat_id)
    {
        $this->id = $id;
        $this->chat_id = $chat_id;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['deleted-chats'];
    }
}
                    

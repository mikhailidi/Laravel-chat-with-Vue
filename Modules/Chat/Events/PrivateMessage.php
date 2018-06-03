<?php

namespace Modules\Chat\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Modules\Chat\Models\Message;

class PrivateMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Message
     */
    protected $message;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('private-message');
    }

    /**
     * Broadcast response
     *
     * @return array
     */
    public function broadcastWith()
    {
        $this->message->load('user');
        $this->message->load('conversation');
        $this->message->conversation->load(['fromUser', 'toUser']);

        return $this->message->toArray();
    }
}

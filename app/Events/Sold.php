<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Sold implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $userid;
    public $article;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $userid, $article)
    {
        $this->message = $message;
        $this->userid = $userid;
        $this->article = $article;

    }

    public function broadcastWith(){
        return [
            'message'=> $this->message,
            'userid'=> $this->userid,
            'article'=> $this->article
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Sale');
    }
}

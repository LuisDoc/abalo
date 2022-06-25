<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Search implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $searches;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($searches)
    {
        $this->searches= $searches;
    }

    public function broadcastWith(){
        return [
            'searches'=> $this->searches,
        ];
    } 

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('Search'); 
    }
}

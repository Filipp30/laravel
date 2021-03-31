<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CallAdmin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $session;
    public $name;
    public $email;
    public $created_at;

    public function __construct($session,$username,$email,$created_at)
    {
        $this->session = $session;
        $this->name = $username;
        $this->email = $email;
        $this->created_at = $created_at;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('my-channel');
    }
}

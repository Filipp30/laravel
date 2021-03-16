<?php

namespace App\Listeners;

use App\Events\ChatMessager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChatMessageNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatMessager  $event
     * @return void
     */
    public function handle(ChatMessager $event)
    {
        //
    }
}

<?php

namespace App\Listeners;

use App\Events\UserNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserNotificationListener
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
     * @param  UserNotificationEvent  $event
     * @return void
     */
    public function handle(UserNotificationEvent $event)
    {
        //
    }
}

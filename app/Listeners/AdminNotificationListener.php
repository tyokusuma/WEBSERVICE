<?php

namespace App\Listeners;

use App\Events\AdminNotificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminNotificationListener
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
     * @param  AdminNotificationEvent  $event
     * @return void
     */
    public function handle(AdminNotificationEvent $event)
    {
        // dd($event);
        // return response()->json([
        //         'data' => $event->message,
        //     ], 200);
    }
}

<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use App\Services\NotificationService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUser
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
     * @param  SendNotificationEvent  $event
     * @return void
     */
    public function handle(SendNotificationEvent $event)
    {
        $data = $event->getData();
        $notification_data = array_except($data, 'user');
        $notification_service = app(NotificationService::class);
        $notification_service->sendNotification($data['user'], $notification_data);
    }
}

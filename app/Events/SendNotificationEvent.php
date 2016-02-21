<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendNotificationEvent extends Event
{
    use SerializesModels;
    protected $user;
    protected $description;
    protected $link;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $description, $link)
    {
        $this->user = $user;
        $this->description = $description;
        $this->link = $link;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    public function getData()
    {
        $data['user'] = $this->user;
        $data['description'] = $this->description;
        $data['link'] = $this->link;

        return $data;
    }

}

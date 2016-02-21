<?php
namespace App\Repositories;


use App\Contracts\NotificationRepository;
use App\Notification;
use App\User;

class MySqlNotificationRepository implements NotificationRepository
{
    private $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function all(User $user)
    {
        $result = $this->notification->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return $result;
    }

    public function find($notification_id)
    {
        $result = $this->notification->find($notification_id);

        return $result;
    }

    public function create(User $receiver, $description, $link)
    {
        $this->notification->user_id = $receiver->id;
        $this->notification->description = $description;
        $this->notification->link = $link;

        $this->notification->create($this->notification->getAttributes());

        return $this->notification;
    }

    public function update(Notification $notification, $data)
    {
        $notification->fill($data);
        $result = $notification->save();

        return $result;
    }

    public function delete(Notification $notification)
    {

    }

    public function unreadNotificationCount(User $user)
    {
        $notifications = $this->all($user)->where('read', '=', false);

        return $notifications->count();
    }
}
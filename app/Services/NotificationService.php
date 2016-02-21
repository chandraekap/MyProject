<?php
namespace App\Services;


use App\Contracts\NotificationRepository;
use App\User;

class NotificationService
{
    private $notification_repo;

    public function __construct(NotificationRepository $notification_repo)
    {
        $this->notification_repo = $notification_repo;
    }

    public function getAllUserNotifications(User $user)
    {
        $notifications = $this->notification_repo->all($user);

        return $notifications;
    }

    public function sendNotification(User $receiver, $data)
    {
        $response = $this->notification_repo->create($receiver, $data['description'], $data['link']);

        return $response;
    }

    public function getUnreadNotificationCount(User $user)
    {
        $unread_notif_count = $this->notification_repo->unreadNotificationCount($user);

        return $unread_notif_count;
    }

    public function readNotification($notification_id)
    {
        $notification = $this->notification_repo->find($notification_id);
        $data['read'] = true;
        $response = $this->notification_repo->update($notification, $data);

        return $response;
    }

    public function unReadNotification($notification_id)
    {
        $notification = $this->notification_repo->find($notification_id);
        $data['read'] = false;
        $response = $this->notification_repo->update($notification, $data);

        return $response;
    }
}
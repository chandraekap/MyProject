<?php
namespace App\Contracts;

use App\Notification;
use App\User;

interface NotificationRepository
{
    public function all(User $user);
    public function find($notification_id);
    public function create(User $receiver, $description, $link);
    public function update(Notification $notification, $data);
    public function delete(Notification $notification);
}
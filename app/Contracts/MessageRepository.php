<?php
namespace App\Contracts;

use App\Message;
use App\User;

interface MessageRepository
{
    public function all(User $user, $role_name);
    public function create(User $sender, User $receiver, $message);
    public function update(Message $msg);
    public function delete(Message $msg);
}
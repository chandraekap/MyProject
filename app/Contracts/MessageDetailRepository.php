<?php
namespace App\Contracts;

use App\Message;
use App\MessageDetail;
use App\User;

interface MessageDetailRepository
{
    public function all(Message $message);
    public function create(Message $message, User $sender, $detail);
    public function update(MessageDetail $detail);
    public function delete(MessageDetail $detail);
}
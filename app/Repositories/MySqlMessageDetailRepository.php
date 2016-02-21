<?php
namespace App\Repositories;


use App\Contracts\MessageDetailRepository;
use App\Message;
use App\MessageDetail;
use App\User;

class MySqlMessageDetailRepository implements MessageDetailRepository
{
    private $detail;

    public function __construct(MessageDetail $detail)
    {
        $this->detail = $detail;
    }

    public function all(Message $message )
    {

    }

    public function create(Message $message, User $sender, $detail)
    {
        $this->detail->message_id = $message->id;
        $this->detail->sender_id = $sender->id;
        $this->detail->message_body = $detail['message_body'];
        $this->detail->read = false;

        $result = $this->detail->create($this->detail->getAttributes());

        return $result;
    }

    public function update(MessageDetail $detail)
    {

    }

    public function delete(MessageDetail $detail)
    {

    }
}
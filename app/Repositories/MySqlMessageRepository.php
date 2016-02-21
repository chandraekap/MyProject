<?php
namespace App\Repositories;


use App\Contracts\MessageRepository;
use App\Message;
use App\User;

class MySqlMessageRepository implements MessageRepository
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function all(User $user, $role_name)
    {
        $filter_key = ($role_name == 'seller')?'receiver_id':'sender_id';

        $result = $this->message->where($filter_key, '=', $user->id)->paginate(10);

        return $result;
    }

    public function find($message_id)
    {
        $result = $this->message->find($message_id);
        $this->message = $result;

        return $result;
    }

    public function create(User $sender, User $receiver, $message)
    {
        $this->message->sender_id = $sender->id;
        $this->message->receiver_id = $receiver->id;
        $this->message->title = $message['title'];

        $result = $this->message->create($this->message->getAttributes());

        $message_detail_repo = app(MySqlMessageDetailRepository::class);
        $message_detail_repo->create($result, $sender, $message);

        return $result;
    }

    public function update(Message $msg)
    {

    }

    public function delete(Message $msg)
    {

    }

    public function addMessageDetail(User $sender, $detail)
    {
        $message = $this->message;
        $message_detail_repo = app(MySqlMessageDetailRepository::class);
        $message_detail_repo->create($message, $sender, $detail);

        return $message;
    }
}
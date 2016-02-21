<?php
namespace App\Services;


use App\Contracts\MessageRepository;
use App\Events\SendNotificationEvent;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    private $message_repo;

    public function __construct(MessageRepository $message_repo)
    {
        $this->message_repo = $message_repo;
    }

    public function sendMessage($sender, $receiver, $message)
    {
        $user_service = app(UserService::class);
        $receiver = $user_service->getUserByEmail($receiver);

        $response = $this->message_repo->create($sender, $receiver, $message);

        $description = $sender->first_name.' send you a new message.';
        $encrypted_message_id = \Crypt::encrypt($response->id);
        $link = '/messages/view/'.$encrypted_message_id;

        event(new SendNotificationEvent($receiver, $description, $link));

        return $response;
    }

    public function loadMessages(User $user, $role_name)
    {
        $response = $this->message_repo->all($user, $role_name);

        return $response;
    }

    public function getMessageByID($message_id)
    {
        $response = $this->message_repo->find($message_id);
        $response->details = $response->details()->orderBy('created_at')->get();

        return $response;
    }

    public function replyMessage($message_id, $message)
    {
        $sender = Auth::user();
        $message_header = $this->message_repo->find($message_id);
        $response = $this->message_repo->addMessageDetail($sender, $message);

        $receiver = $message_header->receiver;
        $description = $sender->first_name.' replied your reply.';
        if($sender->id == $receiver->id)
        {
            $receiver = $message_header->sender;
            $description = $sender->first_name.' replied your message.';
        }

        $encrypted_message_id = \Crypt::encrypt($message_header->id);
        $link = '/messages/view/'.$encrypted_message_id;

        event(new SendNotificationEvent($receiver, $description, $link));

        return $response;
    }
}
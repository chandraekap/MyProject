<?php

namespace App\Http\Controllers;

use App\Message;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        $user = Auth::user();
        $message_service = app(MessageService::class);
        $messages = $message_service->loadMessages($user, $role);

        foreach($messages as $message)
        {
            $message->details = $message->details()->orderBy('created_at', 'desc')->first();
        }

        return view('messages.index')->with(['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($email)
    {
        $email = \Crypt::decrypt($email);
        $user_service = app(UserService::class);
        $receiver = $user_service->getUserByEmail($email);

        return view('messages.new')->with(['receiver' => $receiver]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'message_body' => 'required',
        ]);

        $filter_request = $request->except('_token');
        $sender = Auth::user();
        $message_service = app(MessageService::class);
        $response = $message_service->sendMessage($sender, $filter_request['email'], $filter_request);

        return Redirect::to('/messages/buyer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewMessageDetail($message_id)
    {
        $message_id = \Crypt::decrypt($message_id);
        $message_service = app(MessageService::class);
        $message = $message_service->getMessageByID($message_id);

        $user = auth()->user();
        if($user->id != $message->sender->id && $user->id != $message->receiver->id)
            return Redirect::to('/');

        return view('messages.message-detail')->with(['message' => $message]);
    }

    public function sendReplyMessage(Request $request)
    {
        $excepts = ['_token'];
        $filter_data = $request->except($excepts);
        $message_id = \Crypt::decrypt($filter_data['message_id']);
        $message_service = app(MessageService::class);
        $response = $message_service->replyMessage($message_id, $filter_data);

        return Redirect::back();
    }
}

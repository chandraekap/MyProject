@extends('messages.message-master')
@section('message-content')
    My Message List: <br />
    <table cellspacing="20">
        <thead>
            <tr>
                <th>No.</th>
                <th>Seller Name</th>
                <th>Message Title</th>
                <th>Last Reply</th>
                <th>Replied by</th>
            </tr>
        </thead>
        <tbody>
        @foreach($messages as $key => $message)
            <tr>
                <td>
                    {{ $key+1 }}
                </td>
                <td>
                    {{ $message->receiver->first_name.' '.$message->receiver->last_name }}
                </td>
                <td>
                   <a href="/messages/view/{{ \Crypt::encrypt($message->id) }}">{{ $message->title }}</a>
                </td>
                <td>
                    {{ !empty($message->details->message_body)?$message->details->message_body:'(empty)' }}
                </td>
                <td>
                    {{ !empty($message->details)?$message->details->sender->first_name.' '.$message->details->sender->last_name:'(empty)' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $messages->render() !!}
@endsection

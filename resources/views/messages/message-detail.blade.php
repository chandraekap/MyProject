@extends('messages.message-master')

@section('message-content')
    <table>
        <tr>
            <td>From</td>
            <td>:</td>
            <td>{{ $message->sender->email }}</td>
        </tr>
        <tr>
            <td>To</td>
            <td>:</td>
            <td>{{ $message->receiver->email }}</td>
        </tr>
        <tr>
            <td>Title</td>
            <td>:</td>
            <td>{{ $message->title }}</td>
        </tr>
    </table>
    <br />
    <br />
    <table>
        @foreach($message->details as $detail)
            <tr>
                <td style="padding-right: 25px;">{{
                    \Carbon\Carbon::create($detail->updated_at->year, $detail->updated_at->month, $detail->updated_at->day,
                        $detail->updated_at->hour, $detail->updated_at->minute, $detail->updated_at->second)->diffForHumans()
                    }}</td>
                <td style="padding-right: 50px;">{{ $detail->sender->first_name.' '.$detail->sender->last_name }}</td>
                <td>:</td>
                <td>{{ $detail->message_body }}</td>
            </tr>
        @endforeach
    </table>
    <br />
    <br />

    <form method="post" action="/messages/reply">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="message_id" value="{{ \Crypt::encrypt($message->id) }}" />
        <textarea name="message_body" rows="10" cols="50"></textarea>
        <button type="submit">Reply</button>
    </form>
@endsection
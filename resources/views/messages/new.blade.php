@extends('messages.message-master')

@section('message-content')
    New Message <br />

    @if (count($errors) > 0)
        <table style="color:red">
            @foreach ($errors->all() as $error)
                <tr>
                    <td>
                        {{ $error }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    <br /> <br />

    <form method="post" action="/messages/new">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <table>
            <tr>
                <td>To</td>
                <td>:</td>
                <td>
                    <input type="text" disabled value="{{ $receiver->email }}" />
                    <input type="hidden" name="email" value="{{ $receiver->email }}" />
                </td>
            </tr>
            <tr>
                <td>Title</td>
                <td>:</td>
                <td>
                    <input type="text" name="title" />
                </td>
            </tr>
            <tr>
                <td>Message</td>
                <td>:</td>
                <td>
                    <textarea name="message_body" rows="10" cols="50"></textarea>
                </td>
            </tr>
            <tr align="center">
                <td><button type="submit">Send</button></td>
            </tr>
        </table>
    </form>
@endsection
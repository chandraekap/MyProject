@extends('index')

@section('content')
Notifications : <br />

<table cellspacing="20">
    @foreach($notifications as $notification)
        <tr>
            <td style="padding-right: 25px;">
                <a class="notification-link" href="{{ $notification->link }}">
                    {{ $notification->description }}
                </a>
            </td>
            <td style="padding-right: 25px;">{{
                    \Carbon\Carbon::create($notification->created_at->year, $notification->created_at->month, $notification->created_at->day,
                        $notification->created_at->hour, $notification->created_at->minute, $notification->created_at->second)->diffForHumans()
                    }}
            </td>
            <td>
                <a class="notification-mark" href="/notifications/read/{{ $notification->id }}/{{ $notification->read }}">
                    @if($notification->read)
                       Mark as unread
                    @else
                       Mark as read
                    @endif
                </a>
            </td>
        </tr>
    @endforeach
</table>

    Paging:
    {!! $notifications->render() !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('.notification-link').on('click', function(){
                var flag_link = $(this).closest('tr').find('.notification-mark').attr('href');

                $.ajax({
                    url: flag_link,
                    success: function(msg){
                        console.log('success');
                    }
                });
            });
        });
    </script>
@endsection

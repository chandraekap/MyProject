
<table cellspacing="25">
    <tr>
        <td>
            <a href="/">Home</a>
        </td>
        @if(isset($user))
        <td>
            <a href="/notifications">Notifcation</a>
            @if(!empty($unread_notification))
                ({{ $unread_notification }} unread notifications)
            @endif
        </td>
        <td>
            <a href="/messages/buyer">Message (as buyer)</a>
        </td>
        <td>
            <a href="/seller/all">Seller List</a>
        </td>
        <td>
            @if($user->is_seller)
                <a href="/messages/seller">Message (as seller)</a>
            @else
                <a href="/shop/open">Open Shop </a>
            @endif
        </td>
        <td>
            <a href="/logout">logout</a>
        </td>
        @else
        <td>
            <a href="/login">Login</a>
        </td>
        <td>
            <a href="/registration">Registration</a>
        </td>
        @endif
    </tr>
</table>

<br /> <br /> <br />
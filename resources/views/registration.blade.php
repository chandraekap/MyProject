Registration <br />
@include('navigation')
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

<form method="post" action="register">
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <table>
        <tr>
            <td>First Name</td>
            <td>:</td>
            <td><input type="text" name="first_name" /> </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>:</td>
            <td><input type="text" name="last_name" /> </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><input type="text" name="email" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td>:</td>
            <td><input type="password" name="password_confirmation" /></td>
        </tr>
        <tr align="center">
            <td colspan="3">
                <button type="submit">Register</button>
            </td>
        </tr>
    </table>
</form>


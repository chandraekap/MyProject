E-commerce <br />
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

<form method="post" action="login">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <table>
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
        <tr align="center">
            <td colspan="3"><label><input type="checkbox" name="remember"> Remember Me</label></td>
        </tr>
        <tr align="center">
            <td colspan="3">
                <button type="submit">Login</button>
            </td>
        </tr>
    </table>
</form>
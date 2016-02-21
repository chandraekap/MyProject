@extends('index')

@section('content')
<form method="post" action="/shop/open">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    Shop name: <input type="text" name="shop_name" />
    <button type="submit">Open shop</button>
</form>
@endsection
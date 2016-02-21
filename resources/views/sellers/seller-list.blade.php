@extends('index')

@section('content')
    <form action="/seller/find">
        Find Seller by seller name :
        <input type="text" name="seller_name" />
        <button type="submit">Search</button>
    </form>

    <form action="">
        Urutkan berdasarkan :
        <select name="sort_by">
            <option value="first_name-0">Nama Seller</option>
            <option value="created_at-1">Seller Terbaru</option>
        </select>

        <button type="submit">Urutkan</button>
    </form>

    <table cellspacing="10">
        <thead>
            <tr>
                <th>Seller Name</th>
                <th>Send Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers->unique() as $seller)
                <tr>
                    <td>
                        {{ $seller->first_name.' '.$seller->last_name }}
                    </td>
                    <td>
                        <a href="/messages/new/{{ \Crypt::encrypt($seller->email) }}">New Messages</a> <br />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br />
    Paging:
    {!! $sellers->render() !!}
@endsection

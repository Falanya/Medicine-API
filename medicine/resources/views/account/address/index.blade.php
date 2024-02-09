@extends('main')

@section('main')

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li class="active">
            <a href="{{ route('account.address') }}">Address</a>
        </li>
        <li>
            <a href="{{ route('account.change_password') }}">Password</a>
        </li>
        <li>
            <a href="">Orders</a>
        </li>
    </ul>
</nav>

<h2>My Address</h2>
<br>
<a href="{{ route('account.add_address') }}" class="btn btn-primary">Add new</a>
@if ($address_count > 0)
<form action="{{ route('account.delete_all_address') }}" method="POST" role="form">
    @csrf @method('DELETE')
    <button style="margin-top: 1%" type="submit" class="btn btn-primary" onclick="return confirm('Do you want to remove all addresses?')">Delete all</button>
</form>

<br>
<div class="container">
    <div class="col-md-7">
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $item)
                <tr>
                    <td>
                        <p style="font-weight: 700">{{ $item->receiver_name }}</p>
                        <p>Phone: {{ $item->phone }}</p>
                        <p>{{ $item->address }}</p>
                    </td>
                    <td>
                        
                        <form action="{{ route('account.delete_address', $item->id) }}" method="POST" role="form">
                            @csrf @method('DELETE')

                            <a href="{{ route('account.edit_address', $item->id) }}" class="btn btn-primary">Edit</a>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Do you want to remove this address?')"><i class="fas fa-trash"></i></button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<h3>You hasn't address, please add new!!!</h3>
@endif

@stop
@extends('main')

@section('main')

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li  class="active">
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

<a href="{{ route('account.address') }}" class="btn btn-sm btn-primary">Back</a>

<div class="container">

    <div class="col-md-7 col-md-offset-1">

        <div class="panel panel-info">
            <div class="panel-body">
                <form action="" method="POST" role="form">
                    @csrf
                    <legend>Add new address</legend>

                    <div class="form-group">
                        <label for="">Receiver Name</label>
                        <input type="text" value="{{ $auth->fullname }}" class="form-control" name="receiver_name" placeholder="Input receiver name">
                        @error('receiver_name') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" value="" class="form-control" name="address" placeholder="Input address">
                        @error('address') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" value="" class="form-control" name="phone" placeholder="Input phone">
                        @error('phone') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Password confirm</label>
                        <input type="text" class="form-control" name="password_confirm" placeholder="Input password">
                        @error('password_confirm')
                        <div class="help-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" onclick="return confirm('Would you like to confirm your info?')" class="btn btn-sm btn-primary">Confirm address</button>
                </form>
            </div>
        </div>

    </div>

</div>

@stop


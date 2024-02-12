@extends('main')

@section('main')

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li>
            <a href="{{ route('account.address') }}">Address</a>
        </li>
        <li class="active">
            <a href="{{ route('account.change_password') }}">Password</a>
        </li>
        <li>
            <a href="{{ route('order.history') }}">Orders</a>
        </li>
    </ul>
</nav>

<div class="container">

    <div class="col-md-4 col-md-offset-2">

        <div class="panel panel-info">
            <div class="panel-body">
                <form action="" method="POST" role="form">
                    @csrf
                    <legend>Change password</legend>

                    <div class="form-group">
                        <label for="">Password confirm</label>
                        <input type="text" class="form-control" name="password_confirm" placeholder="Input password">
                        @error('password_confirm')
                        <div class="help-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">New password</label>
                        <input type="text" class="form-control" name="password" placeholder="Input new password">
                        @error('password') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">New password confirm</label>
                        <input type="text" class="form-control" name="new_password_confirm" placeholder="Input new password confirm">
                        @error('new_password_confirm') <small> {{ $message }} </small> @enderror
                    </div>

                    <button type="submit" onclick="return confirm('Would you like to confirm your new password?')" class="btn btn-sm btn-primary">Confirm new password</button>
                </form>
            </div>
        </div>

    </div>

</div>

@stop
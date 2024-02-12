@extends('main')

@section('main')

<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li>
            <a href="{{ route('account.address') }}">Address</a>
        </li>
        <li>
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
                    <legend>Your Profile</legend>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" value="{{ $auth->email }}" class="form-control" name="email" placeholder="Input email" readonly>
                        @error('email') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Fullname</label>
                        <input type="text" value="{{ $auth->fullname }}" class="form-control" name="fullname" placeholder="Input fullname">
                        @error('fullname') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="input" class="form-control" required="required">
                            <option value="1" {{ $auth->gender == 1 ? 'selected' : '' }}>Male</option>
                            <option value="0" {{ $auth->gender == 0 ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Input password">
                        @error('password')
                        <div class="help-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" onclick="return confirm('Would you like to confirm you info?')" class="btn btn-sm btn-primary">Confirm info</button>
                </form>
            </div>
        </div>

    </div>

</div>

@stop


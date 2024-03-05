@extends('main')

@section('main')
    <div class="container">

        <div class="col-md-4 col-md-offset-2">

            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="{{ route('account.process_reset_password') }}" method="POST" role="form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <legend>Reset password</legend>
                        <div class="form-group">
                            <label for="">Old password</label>
                            <input type="password" class="form-control" name="old_password" placeholder="Input old password to reset pass">
                        </div>

                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input new password">
                            @error('password') <small> {{ $message }} </small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Input confirm new password">
                            @error('confirm_password') <small> {{ $message }} </small> @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Reset password</button>
                        <a href="{{ route('account.login') }}">Login</a>
                    </form>
                </div>
            </div>

        </div>

    </div>

@stop
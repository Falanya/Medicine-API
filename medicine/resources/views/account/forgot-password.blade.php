@extends('main')

@section('main')
    <div class="container">

        <div class="col-md-4 col-md-offset-2">

            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="{{ route('account.process_forgot_password') }}" method="POST" role="form">
                        @csrf
                        <legend>Forgot password</legend>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Input email">
                        </div>

                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input old password to reset pass">
                            @error('password') <small> {{ $message }} </small> @enderror
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary">Find account</button>
                        <a href="{{ route('account.login') }}">Login</a>
                    </form>
                </div>
            </div>

        </div>

    </div>

@stop
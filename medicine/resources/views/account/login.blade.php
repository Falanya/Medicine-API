@extends('main')

@section('main')
    <div class="container">

        <div class="col-md-4 col-md-offset-2">

            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="" method="POST" role="form">
                        @csrf
                        <legend>Form login</legend>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Input email">
                            @error('email') <small> {{ $message }} </small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary">Login now</button>
                        </div>
                        <hr>
                        <a href="{{ route('account.register') }}">Sign up |</a>
                        <a href="{{ route('account.forgot_password') }}">Forgot password?</a>
                    </form>
                </div>
            </div>

        </div>

    </div>

@stop
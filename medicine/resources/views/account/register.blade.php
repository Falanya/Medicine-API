@extends('main')
@section('main')
<div class="container">

    <div class="col-md-4 col-md-offset-2">

        <div class="panel panel-info">
            <div class="panel-body">
                <form action="" method="POST" role="form">
                    @csrf
                    <legend>Form register</legend>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Input email">
                        @error('email') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Fullname</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Input fullname">
                        @error('fullname') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="input" class="form-control" required="required">
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Input password">
                        @error('password') <small> {{ $message }} </small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password"
                            placeholder="Input confirm password">
                        @error('confirm_password') <small> {{ $message }} </small> @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Sign up now</button>
                    <a href="{{ route('account.login') }}">Login</a>
                </form>
            </div>
        </div>

    </div>

</div>
@stop
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/customize.css') }}" rel="stylesheet"> --}}

</head>

<body class="gray-bg">

    <div class="middle-box loginscreen animated fadeInDown">
        <div>
            <h3 class="text-center">Đăng ký tài khoản</h3>
            <p>Sức khỏe của bạn là hạnh phúc của chúng tôi.</p>
            <form class="m-t" role="form" action="{{ route('account.post_register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="" class="control-label text-right">Fullname</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Input fullname">
                    @error('fullname') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label text-right">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Input email">
                    @error('email') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label text-right">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Input email">
                    @error('phone') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label text-right">Gender</label>
                    <select name="gender" id="input" class="form-control">
                        <option value="1">Male</option>
                        <option value="0">Female</option>
                    </select>
                    @error('gender') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label text-right">Birthday</label>
                    <input type="date" class="form-control" name="birthday" placeholder="Input birthday">
                    <span><strong>Format: Month/Day/Year</strong></span>
                    @error('address') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>  
                <div class="form-group">
                    <label for="" class="control-label text-right">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Input address">
                    @error('address') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>  
                <div class="form-group">
                    <label for="" class="control-label text-right">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Input password">
                    @error('password') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label for="" class="control-label text-right">Cofirm password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Input confirm password">
                    @error('confirm_password') <small style="color: tomato">{{ $message }}</small> @enderror
                </div> 
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('account.login') }}">Login</a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Libary -->
    <script src="{{ asset('libary/location_register.js') }}"></script>
    <script src="{{ asset('libary/libary.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>

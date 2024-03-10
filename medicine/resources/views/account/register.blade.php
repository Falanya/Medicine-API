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

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Đăng ký tài khoản Medicine Mart</h3>
            <p>Sức khỏe của bạn là hạnh fuck của chúng tôi.</p>
            <form class="m-t" role="form" action="{{ route('account.post_register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Họ và tên">
                    @error('fullname') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email">
                    @error('email') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <select name="gender" id="input" class="form-control">
                        <option value="1">Nam</option>
                        <option value="0">Nữ</option>
                    </select>
                    @error('gender') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                    @error('password') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Xác nhận mật khẩu">
                    @error('confirm_password') <small style="color: tomato">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
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

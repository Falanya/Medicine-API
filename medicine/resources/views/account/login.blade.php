<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Medicine</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Chào mừng bạn đến với Medicine Mart</h2>
            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <a href="{{ route('home.index') }}">Trang chủ</a>
                    <form class="m-t" role="form" action="{{ route('account.post_login')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            @error('email') <small style="color: tomato">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                            @error('password') <small style="color: tomato">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                        <a href="#">
                            <small>Quên mật khẩu?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Bạn không có tài khoản?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ route('account.register') }}">Đăng ký ngay</a>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
    </div>

</body>

</html>

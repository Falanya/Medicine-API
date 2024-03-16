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

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Forgot password</h2>

                    <p>
                        Enter your email address and your password will be reset and emailed to you.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="{{ route('account.process_reset_password') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $token }}" name="token" id="">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="New password">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Cofirm new password">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
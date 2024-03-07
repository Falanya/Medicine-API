<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .vertical-center {
            min-height: 100%;
            min-height: 100vh;
    
            display: flex;
            align-items: center;
        }

        .title-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: aqua;
            height: 50px;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container vertical-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="title-wrapper">
                <p style="font-weight: bold; font-size: 20px">MEDICINE MART ACCOUNT</p>
            </div>

            <div class="panel panel-info">
                <div class="panel-body">
                    <form action="{{ route('account.process_reset_password') }}" method="POST" role="form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="text-center">
                            <h3>Reset password</h3>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">New password</label>
                            <input type="password" class="form-control" name="password" placeholder="Input email">
                            @error('password') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Confirm new password</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="Input email">
                            @error('confirm_password') <small>{{ $message }}</small> @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary">Change password</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

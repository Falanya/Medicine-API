<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{route('home.index')}}">MEDICINE MART</a>
            </li>
            <li class="active">
                <a href="{{route('home.index')}}">Home</a>
            </li>
            <li>
                <a href="{{route('home.about')}}">About US</a>
            </li>
            @if (auth()->check())
            <li>
                <a href="{{route('cart.index')}}">Cart +{{ $cart }}</a>
            </li>
            <li>
                <a href="{{ route('account.profile') }}">Hi {{ auth()->user()->fullname }}</a>
            </li>
            <li>
                <a href="{{ route('account.logout') }}">Logout</a>
           </li>
            @else
            <li>
                <a href="{{ route('account.login') }}">Login</a>
            </li>
            @endif
        </ul>
    </nav>


    <div class="container">

        <div class="row">
            <div class="col-md-3">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Product Type List</h3>
                    </div>

                    <div class="list-group">
                        @foreach ($proTypes as $proTy)
                        <a href="{{ route('home.productType', $proTy->id) }}" class="list-group-item">{{ $proTy->name
                            }}</a>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @yield('main')
            </div>
        </div>

    </div>


</body>

</html>
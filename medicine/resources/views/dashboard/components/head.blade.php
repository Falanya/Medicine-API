<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Medicine Dashboard</title>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<!-- Toastr style -->
<link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<!-- Gritter -->
<link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/customize.css') }}" rel="stylesheet">

@if(isset($config['css']) && is_array($config['css']))
    @foreach($config['css'] as $key => $val)
        <link rel="stylesheet" href="{{ asset($val) }}">
    @endforeach
@endif

<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
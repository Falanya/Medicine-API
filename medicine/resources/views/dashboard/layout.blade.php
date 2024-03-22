<!DOCTYPE html>
<html lang="vn">

<head>
    @include('dashboard.components.head')
</head>

<body>

    <div id="wrapper">
        @include('dashboard.components.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('dashboard.components.nav')
            @include($config)
        </div>
    </div>

    @include('dashboard.components.script')
</body>

</html>

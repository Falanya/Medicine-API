<!DOCTYPE html>
<html>

<head>
    @include('dashboard.components.head')
</head>

<body>
    <div id="wrapper">
        @include('dashboard.components.sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('dashboard.components.nav')
            @include($template)
            @include('dashboard.components.footer')
        </div>
    </div>

    @include('dashboard.components.script')
</body>
</html>

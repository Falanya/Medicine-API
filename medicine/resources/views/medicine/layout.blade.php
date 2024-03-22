<!DOCTYPE html>
<html lang="vn">

<head>
    @include('medicine.components.head')
</head>

<body>

    <div id="wrapper">
        @include('medicine.components.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('medicine.components.nav')
            @include($config)
        </div>
    </div>

    @include('medicine.components.script')
</body>

</html>

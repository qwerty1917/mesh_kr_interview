<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>stock market</title>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    @yield('style')
</head>
<body>

@yield('content')

<script src="{{ URL::asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
@yield('script')

</body>
</html>
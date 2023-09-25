<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Blog App</title>

    </head>
    <body>

        @include('shared.navbar')

        <div class="container">
            @yield('content')
        <div>

    <script src="{{ asset('js/jquery-slim.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    </body>
</html>

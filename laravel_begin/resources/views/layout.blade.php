<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@section('title') Default title @show</title>
        @stack('styles')
            <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        @show
    </head>
    <body>
        @section('header')
            @include('shared.header')
        @show

        <div class="content">
            @yield('content')
        </div>

        @section('footer')
            @include('shared.footer')
        @show
    </body>
</html>
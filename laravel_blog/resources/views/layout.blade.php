<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@section('title') Layout @show</title>
        @stack('styles')
            <link rel="stylesheet" href="{{ asset('css/common.css') }}">
            <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
        @show

    </head>
    <body>
        @section('header')
            @include('shared.header')
        @show

        <main>
            <div class="__content">
                @yield('content')
            </div>
        </main>

        @stack('scripts')

        @show
    </body>
</html>

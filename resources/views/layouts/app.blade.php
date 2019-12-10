<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.navbar')

    <div id="app" class="m-4">
        
        @yield('content')

    </div>
</body>

</html>
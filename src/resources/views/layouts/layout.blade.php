<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ rand() }}">
</head>

<body>
    @yield('header')

    @yield('main')
    @yield('widget')

</body>

</html>

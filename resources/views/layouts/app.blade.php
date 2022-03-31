<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Pets Hotel Retrii
    </title>
    <link rel="stylesheet" href="style.css"/>

    <style>
        .active {
            color: red;
        }
    </style>

</head>
<body>
    <header>
        @include('layouts.header')
    </header>

    @yield('content')

    <!-- Footer -->
    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>
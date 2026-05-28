<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', 'SignLearn')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #FEE6F2; /* INI PENTING */
            color: #5B2B63;      /* INI PENTING */
        }

        h1, h2, h3, h4 {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body>

    @yield('content')

    @stack('scripts')

</body>
</html>
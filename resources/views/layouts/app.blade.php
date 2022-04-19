<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div id="app">
            <!-- Page Heading -->
            <section class="px-8 py-4">
                <header class="container mx-auto">
                    <h1>
                        <img
                            src="{{ asset('/images/logo.svg') }}"
                            alt="Tweety">
                    </h1>
                </header>
            </section>

            <!-- Page Content -->
            <section class="px-8">
                <main class="container mx-auto">
                    @yield('content')
                </main>
            </section>
        </div>
    </body>
</html>

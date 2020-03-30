<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title -->
        <title>Ask Me | Login</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/account_header.css') }}">

        <!-- Script -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/e3fc43b658.js" crossorigin="anonymous"></script>
    </head>
    <body>
        {{-- Header --}}
        <header>
            <div class="container">
                <div class="float-left">
                    {{-- Title --}}
                    <h1>Ask Me</h1>
                </div>

                <div class="float-right">
                    {{-- Home Button --}}
                    <a href="/"><button class="btn"><i class="fas fa-home"></i> <span class="home-link">Home</span></button></a>
                </div>
            </div>
        </header>  

        {{-- Login Component --}}
        <div id="app">
            <login></login>
        </div>
    </body>
</html>
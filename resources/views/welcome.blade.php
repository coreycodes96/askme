<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Title -->
        <title>Ask Me | Home</title>

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">

        <!-- Script -->
        <script src="https://kit.fontawesome.com/e3fc43b658.js" crossorigin="anonymous"></script>
    </head>
    <body>
        {{-- Title & Buttons Container --}}
        <div class="content-container">
            <div>
                {{-- Title --}}
                <h1 class="text align-self-center">AskMe.</h1>

                {{-- Register Button --}}
                <a href="/register"><button class="btn"><i class="fas fa-user-plus"></i> Create An Account</button></a>

                {{-- Login Button --}}
                <a href="/login"><button class="btn"><i class="fas fa-sign-in-alt"></i> Login</button></a>
            </div>
        </div>
    </body>
</html>
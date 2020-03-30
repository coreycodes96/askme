<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Title -->
		<title>Ask Me | Create A Debate</title>

		<!-- Style -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/createadebate.css') }}">

		<!-- Script -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/e3fc43b658.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
	</head>
	<body>
		<div id="app">
			{{-- Loggedin Header Component --}}
			<loggedin-header user="{{ auth()->user() }}" user-notification-count="{{ auth()->user()->notifications->count() }}"></loggedin-header>

			{{-- Question Component --}}
			<questions the-user="{{ auth()->user() }}"></questions>
		</div>
	</body>
</html>
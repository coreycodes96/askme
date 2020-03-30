<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Title -->
		<title>Ask Me | {{ auth()->user() == $user ? "Your Profile" : $user->username."'s Profile" }}</title>

		<!-- Style -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

		<!-- Script -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/e3fc43b658.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<div id="app">
			{{-- Loggedin Header Component --}}
			<loggedin-header user="{{ auth()->user() }}" user-notification-count="{{ auth()->user()->notifications->count() }}"></loggedin-header>
			
			{{-- Profile Component --}}
			<profile loggedin-user="{{ auth()->user() }}" guest-user="{{ $user }}" questions="{{ $questions }}" subscribers="{{ $subscribers }}" subscriptions="{{ $subscriptions }}"></profile>
		</div>
	</body>
</html>
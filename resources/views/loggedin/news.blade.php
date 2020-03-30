<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Title -->
		<title>Ask Me | News</title>

		<!-- Style -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('css/news.css') }}">

		<!-- Script -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/e3fc43b658.js" crossorigin="anonymous"></script>
	</head>
	<body>
		{{-- Loggedin Header Component --}}
		<div id="app">
			<loggedin-header user="{{ auth()->user() }}" user-notification-count="{{ auth()->user()->notifications->count() }}"></loggedin-header>
		</div>
		
		{{-- Update Boxes For Users --}}
		<section class="container news-container">
			<div class="w-100 news-box">
				<h3>Update 1</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
				<br>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>

			<div class="w-100 news-box">
				<h3>Update 2</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>

			<div class="w-100 news-box">
				<h3>Update 3</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>

			<div class="w-100 news-box">
				<h3>Update 4</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>

			<div class="w-100 news-box">
				<h3>Update 5</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>

			<div class="w-100 news-box">
				<h3>Update 6</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, cumque, possimus odio maxime quo hic. Molestiae ut nihil nam ipsum amet magni asperiores, voluptates, nobis, corporis fugiat recusandae beatae qui.
				</p>
			</div>
		</section>
	</body>
</html>

{{-- 
	header
	sidebar

 --}}
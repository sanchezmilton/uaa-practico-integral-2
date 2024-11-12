{{-- resources/views/layout.blade.php --}}
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'MercadoTecno')</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="./layout.css">
</head>

<body>

	{{-- Header con navegación --}}
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">MercadoTecno</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
					<a class="nav-link" href="/">Inicio</a>
				</li>
				<li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
					<a class="nav-link" href="/about">Acerca de</a>
				</li>
				<li class="nav-item {{ request()->is('services') ? 'active' : '' }}">
					<a class="nav-link" href="/services">Servicios</a>
				</li>
				<li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
					<a class="nav-link" href="/contact">Contacto</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container mt-4">
		{{-- Contenido de la vista específica --}}
		@yield('content')
	</div>

	{{-- Footer --}}
	<footer class="bg-light text-center text-lg-start mt-4">
		<div class="text-center p-3">
			&copy; {{ date('Y') }} MercadoTecno. Todos los derechos reservados.
		</div>
	</footer>

	<!-- Scripts de Bootstrap y jQuery desde CDN -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script
		src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
		crossorigin="anonymous"></script>
	<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-auth.js"></script>
	<script>
		// Configuración de Firebase
		const firebaseConfig = {
			apiKey: "AIzaSyAaWLIjFjySp5i5r1FtUXNW_XGnYQS_7cE",
			authDomain: "backend---interfaces.firebaseapp.com",
			databaseURL: "https://backend---interfaces-default-rtdb.firebaseio.com",
			projectId: "backend---interfaces",
			storageBucket: "backend---interfaces.appspot.com",
			messagingSenderId: "779545171534",
			appId: "1:779545171534:web:744d5fa34fbcb24852551f"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
		firebase.analytics();
	</script>
</body>

</html>
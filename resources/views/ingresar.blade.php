@extends('layout')

@section('title', 'Ingresar')

@section('content')
<form id="login-form">
	<fieldset>
		<label for="email_input" class="form-label">Email</label>
		<input type="email" class="form-control" id="email_input" placeholder="ejemplo@mail.com" required>
	</fieldset>
	<fieldset>
		<label for="password_input" class="form-label">Contraseña</label>
		<input type="password" class="form-control" id="password_input" required>
	</fieldset>
	<fieldset>
		<label for="captcha" class="form-label">Captcha</label>
		<figure>
			<img src="captcha.php" alt="Captcha" />
			<input type="text" id="captcha" required />
		</figure>
	</fieldset>
	<button type="button" onclick="login()">Ingresar</button>
</form>

<script type="text/javascript">
	function removeLastSegmentFromPathname() {
		const pathname = window.location.pathname;
		const segments = pathname.split('/');
		segments.pop();
		return segments.join('/');
	}

	function login() {
		let email = $("#email_input").val();
		let password = $("#password_input").val();
		let captcha = $("#captcha").val();


		$.post(
			"check_captcha.php", {
				captcha
			},
			function(data) {
				console.log(data);
				const res = JSON.parse(data);
				if (!res.success) {
					console.error(res.message);
					alert(res.message);
				} else {
					firebase
						.auth()
						.signInWithEmailAndPassword(email, password).then(() => {
							$.post("save_user_session.php", {
								email
							}, function(data) {
								console.log(data);
								const res = JSON.parse(data);
								if (!res.success) {
									console.error(res.message);
									alert(res.message);
								} else {
									const inicio = removeLastSegmentFromPathname();
									window.location = inicio;
									return;
								}
							})
						}, (error) => {
							console.error(error)
						});
				}
			}
		);
	}
</script>
<script>
	document.getElementById("captcha").onclick = function() {
		this.src = "captcha.php?" + Math.random();
	};
</script>
@endsection
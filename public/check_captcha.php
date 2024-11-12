<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$user_input = $_POST['captcha'];
	$captcha_text = $_SESSION['tmptxt'];

	if ($user_input === $captcha_text) {
		die(json_encode(["success" => true]));
		echo "Captcha verificado con éxito.";
	} else {
		die(json_encode(["success" => true, "message" => "Captcha incorrecto."]));
	}
}

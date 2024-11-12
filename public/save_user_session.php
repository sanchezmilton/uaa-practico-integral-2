<?php

session_start();

include "sanitize.php";

if (!isset($_POST['email'])) {
	die(json_encode(["success" => false, "message" => "No se encuentra el email para guardar la sesión"]));
}

$email = sanitize_email($_POST['email']);

if (!$email) {
	die(json_encode(["success" => false, "message" => "Error al sanitizar email"]));
}

$_SESSION["email"] = $email;

die(json_encode(["success" => true]));

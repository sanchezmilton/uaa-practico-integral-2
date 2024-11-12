<?php

session_start();

if (!isset($_SESSION["email"])) {
	die(json_encode(["success" => false, "message" => "Usuario no logueado", "code" => 1]));
}

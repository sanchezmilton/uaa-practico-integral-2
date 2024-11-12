<?php

include "sanitize.php";
include "verify_login.php";

if (!isset($_POST["product_id"])) {
	die(json_encode(["success" => false, "message" => "No se encontró product_id en la solicitud"]));
}

$product_id = sanitize_integer($_POST["product_id"]);

if (!$product_id) {
	die(json_encode(["success" => false, "message" => "Error al sanitizar product_id"]));
}

$cart = [];
if (isset($_SESSION["cart"])) {
	$cart = $_SESSION["cart"];
}

if (isset($cart[$product_id])) {
	$cart[$product_id]++;
} else {
	$cart[$product_id] = 1;
}

$_SESSION["cart"] = $cart;

die(json_encode(["success" => true, "cart" => $cart]));

<?php

include "database.php";

$cart = [];
if (!isset($_SESSION["cart"])) {
	$products = [];
} else {
	$cart = $_SESSION["cart"];
	$productIds = array_keys($_SESSION["cart"]);

	if (count($productIds) > 0) {
		$connection = connectDB();
		$placeholders = implode(',', array_fill(0, count($productIds), '?'));

		$query = "SELECT * FROM products WHERE id IN ($placeholders)";

		$products = executeSimpleQuery($connection, $query, str_repeat('i', count($productIds)), ...$productIds);

		foreach ($products as &$product) {
			$productId = $product['id'];
			$product['quantity'] = $cart[$productId];
		}
	} else {
		$products = [];
	}
}

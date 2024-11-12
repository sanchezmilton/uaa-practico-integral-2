<?php

include "database.php";

echo print_r($_SESSION["cart"]);

$connection = connectDB();
$query = "SELECT * FROM products";
$products = executeSimpleQuery($connection, $query, '');

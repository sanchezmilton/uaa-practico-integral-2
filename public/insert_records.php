<?php
include 'database.php';

$queries = [
	["INSERT INTO products (description, price) VALUES (?, ?)", 'sd', "Producto A", 29.99],
	["INSERT INTO products (description, price) VALUES (?, ?)", 'sd', "Producto B", 39.99],
	["INSERT INTO users (name, email, password) VALUES (?, ?, ?)", 'sss', "John Doe", "john.doe@example.com", "hashed_password_123"]
];

$connection = connectDB();

foreach ($queries as $queryData) {
	$query = $queryData[0];
	$types = $queryData[1];
	$params = array_slice($queryData, 2);

	if (executeModificationQuery($connection, $query, $types, ...$params)) {
		echo "Registro insertado con éxito para la query: $query<br>";
	} else {
		echo "Error al insertar el registro para la query: $query<br>";
	}
}

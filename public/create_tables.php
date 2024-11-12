<?php
include 'database.php';

$queries = [
	"CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        description VARCHAR(255) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
	"CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

$connection = connectDB();

foreach ($queries as $query) {
	if (executeModificationQuery($connection, $query, '')) {
		echo "Query ejecutada con éxito: $query<br>";
	} else {
		echo "Error al ejecutar la query: $query<br>";
	}
}

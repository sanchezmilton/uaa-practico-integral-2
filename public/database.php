<?php
// Database connection function
function connectDB()
{
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$dbName = 'ecommerce_db';

	$connection = new mysqli($host, $user, $password, $dbName);

	if ($connection->connect_error) {
		die("Connection error: " . $connection->connect_error);
	}

	return $connection;
}

// Function to execute a simple SELECT query
function executeSimpleQuery($connection, $query, $types, ...$params)
{
	$stmt = $connection->prepare($query);
	if (!$stmt) {
		die("Preparation error: " . $connection->error);
	}

	if (!empty($types) && !empty($params)) {
		$stmt->bind_param($types, ...$params);
	}

	$stmt->execute();
	$result = $stmt->get_result();

	$rows = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	return $rows;
}

// Function to execute INSERT, UPDATE, or DELETE queries
function executeModificationQuery($connection, $query, $types, ...$params)
{
	$stmt = $connection->prepare($query);
	if (!$stmt) {
		die("Preparation error: " . $connection->error);
	}

	$stmt->bind_param($types, ...$params);
	$result = $stmt->execute();

	$stmt->close();
	return $result;
}

// Function to execute multiple queries
function executeMultipleQueries($connection, $queries)
{
	$results = [];
	if ($connection->multi_query($queries)) {
		do {
			if ($result = $connection->store_result()) {
				$results[] = $result->fetch_all(MYSQLI_ASSOC);
				$result->free();
			}
		} while ($connection->next_result());
	} else {
		die("Error executing multiple queries: " . $connection->error);
	}
	return $results;
}

<?php

function sanitize_email($email)
{
	return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitize_string($string)
{
	return htmlspecialchars(strip_tags(trim($string)));
}

function sanitize_integer($integer)
{
	return filter_var(trim($integer), FILTER_SANITIZE_NUMBER_INT);
}

function sanitize_float($float)
{
	return filter_var(trim($float), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function sanitize_date($date_input)
{
	$date = DateTime::createFromFormat('Y-m-d', trim($date_input));
	if ($date && $date->format('Y-m-d') === trim($date_input)) {
		return $date->format('Y-m-d'); // Devuelve la fecha en formato Y-m-d
	}
	return null; // O manejar error de fecha no válida
}

function sanitize_url($url)
{
	return filter_var(trim($url), FILTER_SANITIZE_URL);
}

function sanitize_phone($phone_input)
{
	return preg_replace('/[^0-9]/', '', trim($phone_input)); // Solo permite dígitos
}

function sanitize_array($array_input)
{
	return array_map('sanitize_string', $array_input);
}

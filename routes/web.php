<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio');
Route::view('/ingresar', 'ingresar');
Route::view('/registrar', 'registrar');
Route::view('/carrito', 'carrito');
Route::view('/envios', 'envios');

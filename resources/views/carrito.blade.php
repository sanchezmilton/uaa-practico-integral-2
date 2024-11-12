<?php include "get_cart.php"; ?>

@extends('layout')

@section('title', 'Carrito')

@section('content')

@if($products && count($products) > 0)
<section class="cart-section">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Descripción</th>
				<th scope="col">Cantidad</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
			<tr>
				<th scope="row">{{ $product['description'] }}</th>
				<th>{{ $product['quantity'] }}</th>
			</tr>
			@endforeach
		</tbody>
	</table>
</section>
@else
<p>Sin productos en el carrito {{ count($cart) }}</p>
@endif

@endsection
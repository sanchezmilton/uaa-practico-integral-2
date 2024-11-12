<?php include "get_products.php"; ?>

@extends('layout')

@section('title', 'Inicio')

@section('content')
@if($products && count($products) > 0)
<section class="products-section">
	@foreach($products as $product)
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">{{ $product['description'] }}</h5>
			<h6 class="card-subtitle mb-2 text-body-secondary">ID: {{ $product['id'] }}</h6>
			<p class="card-text">{{ $product['price'] }}</p>
			<button class="btn btn-primary" onclick="addToCart(`{{ $product['id'] }}`)">+</button>
		</div>
	</div>
	@endforeach
	<a href="carrito" class="btn btn-primary">Ver carrito</a>
</section>
<script type="text/javascript">
	function addToCart(product_id) {
		$.post(
			"add_to_cart.php", {
				product_id,
			},
			function(data) {
				console.log(data);
				const res = JSON.parse(data);
				if (!res.success) {
					if (res.code === 1) {
						window.location = "ingresar";
					} else {
						console.log(res.message);
						alert(res.message);
					}
				} else {
					console.log("Producto agregado al carrito exitosamente");
					alert("Producto agregado al carrito exitosamente");
				}
			}
		);
	}
</script>
@else
<p>Sin productos disponibles</p>
@endif

@endsection
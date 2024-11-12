<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		// Insertar registros en la tabla 'products'
		DB::table('products')->insert([
			[
				'description' => 'Product 1',
				'price' => 19.99,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'description' => 'Product 2',
				'price' => 29.99,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'description' => 'Product 3',
				'price' => 39.99,
				'created_at' => now(),
				'updated_at' => now(),
			],
			// Puedes añadir más productos aquí
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		// Eliminar los productos insertados (opcional)
		DB::table('products')->whereIn('description', ['Product 1', 'Product 2', 'Product 3'])->delete();
	}
};

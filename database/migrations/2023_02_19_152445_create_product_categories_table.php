<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductCategoriesTable.
 */
class CreateProductCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_categories', function(Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('product_id');
            $table->timestamps();

			$table->index('id');
			$table->index('category_id');
			$table->index('product_id');

			$table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
			$table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_categories');
	}
}

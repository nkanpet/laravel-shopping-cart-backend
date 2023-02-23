<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCategoriesTable.
 */
class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('name');
			$table->tinyInteger('status');
            $table->timestamps();

			$table->index('id');
			$table->index('parent_id');

			$table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}
}

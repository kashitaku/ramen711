<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('station1', 30);
			$table->string('station2', 30)->nullable();
			$table->string('type1', 10);
			$table->string('type2', 10)->nullable();
			$table->text('point', 65535);
			$table->string('URL');
			$table->timestamps();
			$table->text('notes', 65535)->nullable();
			$table->integer('rank')->nullable();
			$table->softDeletes();
			$table->string('image_url')->nullable();
			$table->integer('likes_count')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shops');
	}

}

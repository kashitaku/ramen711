<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTwitterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('twitter_id')->nullable()->after('password');
			$table->string('handle')->nullable()->after('twitter_id');
			$table->string('avatar')->nullable()->after('handle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
			$table->string('twitter_id');
			$table->string('handle');
			$table->string('avatar');
        });
    }
}

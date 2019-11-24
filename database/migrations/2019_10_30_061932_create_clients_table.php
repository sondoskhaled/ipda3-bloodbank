<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('name');
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->string('pin_code')->nullable();
			$table->integer('city_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->string('api_token', 60)->unique()->nullable();
			$table->boolean('is_active')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
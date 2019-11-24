<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notification_setting_text');
			$table->text('about_us');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_link');
			$table->string('tw_link');
			$table->string('insta_link');
			$table->string('youtube_link');
			$table->string('google_plus_link');
			$table->string('whatsapp_link');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
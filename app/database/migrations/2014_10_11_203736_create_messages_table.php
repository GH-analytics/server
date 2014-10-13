<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('participant_id');
            $table->unsignedInteger('conversation_id');
            $table->string('type');
            $table->string('message', 2000);
            $table->timestamp('timestamp');

            $table->foreign('participant_id')->references('id')->on('participants');
            $table->foreign('conversation_id')->references('id')->on('conversations');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}

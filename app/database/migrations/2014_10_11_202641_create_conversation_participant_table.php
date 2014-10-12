<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationParticipantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conversation_participant', function(Blueprint $table){
            $table->unsignedInteger('conversation_id');
            $table->unsignedInteger('participant_id');

            $table->foreign('conversation_id')->references('id')->on('conversations');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conversation_participant');
	}

}

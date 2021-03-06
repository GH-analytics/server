<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('uploads', function(Blueprint $table)
            {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->string('filename', 250);
                $table->string('filesize', 250);
                $table->boolean('synced');
                $table->timestamps();
                
                $table->foreign('user_id')->references('id')->on('users');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::drop('uploads');
	}

}

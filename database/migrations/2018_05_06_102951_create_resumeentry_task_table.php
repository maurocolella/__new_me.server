<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeentryTaskTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resume_entry_task', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('resume_entry_id')->unsigned()->nullable();
			$table->foreign('resume_entry_id')->references('id')
				->on('resume_entries')->onDelete('cascade');

			$table->integer('task_id')->unsigned()->nullable();
			$table->foreign('task_id')->references('id')
				->on('tasks')->onDelete('cascade');

			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('resume_entry_task');
	}
}

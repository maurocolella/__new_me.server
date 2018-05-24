<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillSkillTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skill_skill', function (Blueprint $table) {
			$table->increments('id');

			$table->integer('skill_id')->unsigned()->nullable(FALSE);
			$table->foreign('skill_id')->references('id')
				->on('skills')->onDelete('cascade');

			$table->integer('related_id')->unsigned()->nullable(FALSE);
			$table->foreign('related_id')->references('id')
				->on('skills')->onDelete('cascade');

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
		Schema::table('skill_skill', function (Blueprint $table) {
			Schema::dropIfExists('skill_skill');
		});
	}
}

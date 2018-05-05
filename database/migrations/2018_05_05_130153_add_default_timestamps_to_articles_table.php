<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// use Doctrine\DBAL\Types\Type;

class AddDefaultTimestampsToArticlesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Type::addType('timestamp', 'DoctrineTimestamp\DBAL\Types\Timestamp');
		// DB::getDoctrineConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('Timestamp', 'timestamp');
		// Schema::table('articles', function (Blueprint $table) {
			// $table->timestamp('created_at')->useCurrent()->change();
			// $table->timestamp('updated_at')->useCurrent()->change();
		// });

		DB::statement('ALTER TABLE articles MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
		DB::statement('ALTER TABLE articles MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('articles', function (Blueprint $table) {
			//
		});
	}
}

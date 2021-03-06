<?php

use Illuminate\Database\Seeder;
Use App\Article;

class ArticlesTableSeeder extends Seeder
{
	public function run()
	{
		// Let's truncate our existing records to start from scratch.
		Article::truncate();

		$faker = \Faker\Factory::create();

		// And now, let's create a few articles in our database:
		for ($i = 0; $i < 5; $i++) {
			Article::create([
				'title' => $faker->sentence,
				'slug' => $faker->word,
				'body' => $faker->paragraph,
			]);
		}
	}
}

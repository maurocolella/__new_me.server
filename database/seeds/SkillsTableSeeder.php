<?php

use Illuminate\Database\Seeder;
use App\Skill;

class SkillsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Let's truncate our existing records to start from scratch.
		Skill::truncate();

		$faker = \Faker\Factory::create();

		// And now, let's create a few articles in our database:
		for ($i = 0; $i < 20; $i++) {
			Skill::create([
				'title' => $faker->sentence,
				'rating' => $faker->randomFloat(2, 0, 100),
			]);
		}
	}
}

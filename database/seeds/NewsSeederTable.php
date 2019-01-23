<?php

use Illuminate\Database\Seeder;
use App\NewsCategory;

class NewsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	NewsCategory::create(['name' => 'Uncategorized']);

        	$faker = Faker\Factory::create();
		    for($i = 0; $i < 10; $i++) {
		        App\News::create([
		            'title' => $faker->sentence(5),
		            'description' => $faker->sentence(100),
		            'author' => 3,
		            'category_id'=>1
		        ]);
		    }
    }
}

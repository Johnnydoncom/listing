<?php

use App\Make;
use Illuminate\Database\Seeder;

class MakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makes = config('listing-option.makes');
    	foreach ($makes as $make) {
    		$add = Make::create(['name' => $make]);

            $faker = Faker\Factory::create();
            for($i = 0; $i < 5; $i++) {
                App\CarModel::create([
                    'name' => $faker->sentence(1),
                    'make_id' => $add->id
                ]);
            }

    	}
    }
}

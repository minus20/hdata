<?php

use App\Review;
use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::truncate();
//        $faker = Faker\Factory::create();
//        foreach (range(0, 10) as $i) {
//            Review::create([
//                'user_id' => $faker->numberBetween(1,10),
//                'company_id' => $faker->numberBetween(1,10),
//                'rating' => $faker->numberBetween(1, 5),
//                'comment' => $faker->text,
//            ]);
//        }
    }
}

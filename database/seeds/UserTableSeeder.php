<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
//        $faker = \Faker\Factory::create();
//        foreach(range(0, 10) as $i) {
//            \App\User::create([
//                'name' => $faker->name,
//                'login' => $faker->userName,
//                'password' => bcrypt('password'),
//                'api_token' => uniqid(),
//            ]);
//        }

        \App\User::create([
            'name' => 'Administrator',
            'login' => 'hdataadmin',
            'password' => bcrypt('&aR7SUSRK6n*Xk9u'),
            'api_token' => uniqid(),
            'role' => 'admin'
        ]);
    }
}

<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        $faker = \Faker\Factory::create();
//        factory(Company::class, 10)->create();
        foreach (range(0, 10) as $i ) {
            $company = new Company([
                'name' => $faker->company,
                'description' => $faker->sentence,
                'approved' => 1
            ]);
            $company->save();
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: labmma
 * Date: 25.04.2019
 * Time: 10:03
 */

/* @var $factory \Illuminate\Database\Eloquent\Factory */

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence,
        'approved' => 1
    ];
});

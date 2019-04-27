<?php
/**
 * Created by PhpStorm.
 * User: labmma
 * Date: 25.04.2019
 * Time: 10:03
 */

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

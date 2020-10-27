<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ad;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {
    return [
        'category_id' => '1',
        'size_id' => '1',
        'title_ar' => $faker->title,
        'title_en' => $faker->title,
        'price' => $faker->numberBetween('50','500'),
        'image' => 'image.png',
        'type' => $faker->numberBetween('1','2'),
        'status' => $faker->numberBetween('1','2'),
        'stock' => '500',
    ];
});

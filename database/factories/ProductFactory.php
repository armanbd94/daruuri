<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Backend\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'brand_id' => rand(4,6),
        'category_id' => rand(3,4),
        'product_name' => $faker->unique()->sentence,
        'product_image' => $faker->imageUrl(),
        'description' => $faker->text,
        'status' => 1
        
    ];
});

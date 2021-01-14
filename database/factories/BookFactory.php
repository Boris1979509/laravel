<?php

/** @var Factory $factory */

use App\Models\Admin\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Book::class, static function (Faker $faker) {
    return [
        'name'  => $faker->sentence(random_int(1, 3)),
        'price' => random_int(1000, 5000),
    ];
});

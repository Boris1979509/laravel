<?php

/** @var Factory $factory */

use App\Models\Admin\Author;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Author::class, static function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});

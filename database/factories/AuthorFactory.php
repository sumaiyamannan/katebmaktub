<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->numberBetween(1,20),  //creating dummy data with relation to user model
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'author_image' => $faker->imageUrl('900', '300'),
        'body' => $faker->paragraph,
        'ISNI' => $faker->isbn13,
        'date_of_birth' => $faker->date(),
        'date_of_flourish' => $faker->date(),
        'email' => $faker->unique()->safeEmail,
        'contact_number' => $faker->phoneNumber
    ];
});

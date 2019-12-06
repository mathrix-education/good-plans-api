<?php

declare(strict_types=1);

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 *
 * UserFactory
 *
 * @var Factory $factory
 */

$factory->define(User::class, static function (Generator $faker) {

    return [
        'email'         => $faker->email,
        'firstname'     => $faker->firstName,
        'lastname'      => $faker->lastName,
        'password'      => $faker->password,
        'city'          => $faker->city,
        'universities'  => $faker->words($faker->numberBetween(0,5)),
        'birthdate'    => $faker->dateTime,
        'created_at'    => $faker->dateTime,
        'updated_at'    => $faker->dateTime,
    ];
});

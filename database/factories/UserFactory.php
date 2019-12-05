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
    [$createdAt, $updatedAt] = timestamps();

    return [
        'email'         => $faker->email,
        'firstname'     => $faker->firstName,
        'lastname'      => $faker->lastName,
        'city'          => $faker->city,
        'universities'  => $faker->sentence,
        'birth_date'    => $faker->dateTime,
    ];
});

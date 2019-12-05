<?php
declare(strict_types=1);

use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 *
 * UserFactory
 *
 * @var Factory $factory
 */

$factory->define(Institution::class, static function (Generator $faker) {
    [$createdAt, $updatedAt] = timestamps();

    return [
        'name'          => $faker->word,
        'description'   => $faker->text,
        'city'          => $faker->city,
    ];
});

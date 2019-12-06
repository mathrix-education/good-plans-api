<?php
declare(strict_types=1);

use App\Models\Institution;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 *
 * UserFactory
 *
 * @var Factory $factory
 */

$factory->define(Institution::class, static function (Generator $faker) {

    return [
        'name'          => $faker->word,
        'description'   => $faker->text,
        'cities'        => $faker->words($faker->numberBetween(1,5)),
        'created_at'    => $faker->dateTime,
        'updated_at'    => $faker->dateTime,
    ];
});

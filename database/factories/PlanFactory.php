<?php

declare(strict_types=1);

use App\Models\Institution;
use App\Models\Plan;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 *
 * UserFactory
 *
 * @var Factory $factory
 */

$factory->define(Plan::class, static function (Generator $faker) {

    return [
        'title'          => $faker->sentence,
        'description'    => $faker->text,
        'link'           => $faker->url,
        'institution_id' => Institution::random()->id,
        'starting_at'    => $faker->dateTime,
        'ending_at'      => $faker->dateTime,
        'city'           => $faker->boolean ? 'Paris' : 'Grenoble',
        'age_min'        => $faker->numberBetween(13, 15),
        'age_max'        => $faker->numberBetween(18, 25),
        'video_id'       => $faker->url,
        'created_at'     => $faker->dateTime,
        'updated_at'     => $faker->dateTime,
    ];
});

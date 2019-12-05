<?php


declare(strict_types=1);

use App\Models\Plan;
use App\Models\Institution;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;

/**
 *
 * UserFactory
 *
 * @var Factory $factory
 */

$factory->define(Plan::class, static function (Generator $faker) {
    [$createdAt, $updatedAt] = timestamps();

    return [
        'title'             => $faker->sentence,
        'description'       => $faker->text,
        'link'              => $faker->url,
        'institution_id'    => Institution::random()->id,
        'ending_at'         => $faker->dateTime,
        'locations'         => $faker->city,
        'categories'        => $faker->words(3,true),
        'filters'           => [
            'age_min' => $faker->numberBetween(13,15),
            'age_max' => $faker->numberBetween(18,25),
        ],
        'video_id'          => $faker->url,
    ];
});

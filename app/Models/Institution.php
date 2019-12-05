<?php


namespace App\Models;

use Carbon\Carbon;

/**
 * @property int            $id
 * @property string|null    $name
 * @property string|null    $description
 * @property string|null    $city
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 */

class Institution
{
    /** @var bool If timestamps (created_at and updated_at) should be used */
    public $timestamps = true;

    /** @var array The guarded attributes */
    protected $fillable = [
        'name',
        'description',
        'city',
    ];
}

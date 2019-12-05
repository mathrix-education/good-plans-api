<?php


namespace App\Models;

use Carbon\Carbon;
use phpDocumentor\Reflection\Location;

/**
 * @property int            $id
 * @property string|null    $title
 * @property string|null    $description
 * @property string|null    $link
 * @property int|null       $institution_id
 * @property Carbon         $ending_at
 * @property string|null    $locations
 * @property string|null    $categories
 * @property array          $filters
 * @property string|null    $video_id
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 */

class Plan
{
    /** @var bool If timestamps (created_at and updated_at) should be used */
    public $timestamps = true;

    /** @var array The guarded attributes */
    protected $fillable = [
        'title',
        'description',
        'link',
        'institution_id',
        'ending_at',
        'locations',
        'categories',
        'filters',
        'video_id',
    ];
}
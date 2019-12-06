<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mathrix\Lumen\Zero\Models\BaseModel;


/**
 * @property int            $id
 * @property string|null    $title
 * @property string|null    $description
 * @property string|null    $link
 * @property int|null       $institution_id
 * @property Carbon|null    $starting_at
 * @property Carbon|null    $ending_at
 * @property array          $cities
 * @property array          $categories
 * @property array          $filters
 * @property string|null    $video_id
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 * ---
 * @property Institution    $institutions
 */
class Plan extends BaseModel
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

    protected $attributes = [
        'cities'        => '[]',
        'filters'       => '[]',
        'categories'    => '[]'
    ];

    protected $casts = [
        'cities'        => 'array',
        'categories'    => 'array',
        'filters'       => 'array',
    ];

    /**
     * BelongsTo Institution
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}

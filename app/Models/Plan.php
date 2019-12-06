<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * @property int         $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $link
 * @property int|null    $institution_id
 * @property Carbon|null $starting_at
 * @property Carbon|null $ending_at
 * @property int         $age_min
 * @property int         $age_max
 * @property string      $city
 * @property string      $category
 * @property string|null $video_id
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 * ---
 * @property Institution $institutions
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
        'age_min',
        'age_max',
        'city',
        'ending_at',
        'locations',
        'categories',
        'video_id',
    ];

    protected $appends = ['rating_mean'];

    /**
     * BelongsTo Institution
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * @return HasMany<Rating>
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getRatingMeanAttribute(): ?float
    {
        $ratings = $this->ratings()->get(['value'])->pluck('value');

        if ($ratings->count() === 0) {
            return null;
        }

        return round($ratings->sum() / $ratings->count(), 2);
    }
}

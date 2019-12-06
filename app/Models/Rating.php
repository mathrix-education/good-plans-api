<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * @property-read int $id
 * @property int      $value
 * @property int      $plan_id
 * ---
 * @property Plan     $plan
 */
class Rating extends BaseModel
{
    protected $fillable = ['value', 'plan_id'];
    /**
     * @return BelongsTo<Plan>
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}

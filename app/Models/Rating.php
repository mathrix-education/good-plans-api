<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * @property-read int $id
 * @property int      $value
 * @property int      $plan_id
 * @property int      $user_id
 * ---
 * @property Plan     $plan
 * @property User     $user
 */
class Rating extends BaseModel
{
    protected $fillable = ['value', 'plan_id', 'user_id'];

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Plan>
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}

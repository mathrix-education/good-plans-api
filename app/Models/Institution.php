<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mathrix\Lumen\Zero\Models\BaseModel;


/**
 * @property int                $id
 * @property string|null        $name
 * @property string|null        $description
 * @property array              $cities
 * @property Carbon             $created_at
 * @property Carbon             $updated_at
 * ---
 * @property Collection|Plan[]  $plans
 */
class Institution extends BaseModel
{
    /** @var bool If timestamps (created_at and updated_at) should be used */
    public $timestamps = true;

    /** @var array The guarded attributes */
    protected $fillable = [
        'name',
        'description',
    ];

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
}

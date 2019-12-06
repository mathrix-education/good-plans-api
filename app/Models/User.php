<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Mathrix\Lumen\JWT\Auth\HasJWT;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * @property int            $id
 * @property string|null    $firstname
 * @property string|null    $lastname
 * @property string         $email
 * @property string         $password
 * @property Carbon|null    $birthdate
 * @property string|null    $city
 * @property array|null     $universities
 * @property string         $token
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 * ---
 * @property-read string    $provider
 */
class User extends BaseModel implements AuthenticatableContract
{

    use Authenticatable;
    use HasJWT;

    /** @var bool If timestamps (created_at and updated_at) should be used */
    public $timestamps = true;

    /** @var array The guarded attributes */
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'email',
        'password',
        'birthdate',
        'city',
        'university',
    ];

    /** @var array The hidden attributes from the model's JSON */
    protected $hidden = [
        'password',
        'token',
    ];

    /** @var array The validation rules on create */
    protected $rules = [
        'firstname'                 => 'nullable|max:60',
        'lastname'                  => 'nullable|max:60',
        'password'                  => 'nullable|min:3',
        'token'                     => 'nullable|size:36',
    ];

    /** @var array The virtual attributes */
    protected $appends = [
        'provider'
    ];

    public function getProviderAttribute() : string
    {
        return 'api';
    }
}
